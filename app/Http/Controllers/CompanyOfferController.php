<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferApplyRequest;
use App\Http\Requests\OfferRequest;
use App\Models\ApplyOffer;
use App\Models\CompanyOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class CompanyOfferController extends Controller
{
    public function index()
    {
        $offers = CompanyOffer::paginate(10);

        return view('offers/index', [
            'offers' => $offers
        ]);
    }

    public function single($slug, $id)
    {
        $offer = CompanyOffer::find($id);
        $company = $offer->company;
        $offer->seen = $offer->seen + 1;
        $offer->save();

        if(!$offer->active) {
            return redirect()->route('offers');
        }elseif(!$offer->company->active) {
            return redirect()->route('offers');
        }

        return view('offers/single', [
            'offer' => $offer,
            'company' => $company
        ]);
    }

    public function store(OfferRequest $request)
    {
        $offer = new CompanyOffer();
        $offer->title = $request->title;
        $offer->slug = Str::slug($request->title, '-');
        $offer->short_description = $request->short_description;
        $offer->description = $request->description;
        $offer->contract_type = $request->contract_type;
        $offer->annual_salary_minumun = $request->annual_salary_minumun;
        $offer->annual_salary_maximun = $request->annual_salary_maximun;
        $offer->advantages = $request->advantages;
        $offer->city = $request->city;
        $offer->location = $request->location;
        $offer->experience = $request->experience;
        $offer->languages_required = $request->languages_required;
        $offer->company_id = Auth::user()->company->id;
        $offer->save();

        return redirect()->route('dashboard.offers')->with('success', 'Offre ajoutée avec succès');
    }

    public function delete($id)
    {

        $offer = CompanyOffer::find($id);

        if ($offer->company_id !== Auth::user()->company->id) {
            return redirect()->route('dashboard.offers');
        }

        $offer->favoriteUsers()->detach();

        if($offer->apply) {
            foreach($offer->apply as $apply) {
                if($apply->curriculum) {
                    unlink(public_path($apply->curriculum));
                }
                if($apply->cover_letter) {
                    unlink(public_path($apply->cover_letter));
                }

                $apply->delete();
            }
        }

        $offer->delete();

        return redirect()->route('dashboard.offers')->with('success', 'Offre supprimée avec succès');
    }

    public function update(OfferRequest $request, $id)
    {
        $offer = CompanyOffer::find($id);

        if ($offer->company_id !== Auth::user()->company->id) {
            return redirect()->route('dashboard.offers');
        }

        $offer->title = $request->title;
        $offer->slug = Str::slug($request->title, '-');
        $offer->short_description = $request->short_description;
        $offer->description = $request->description;
        $offer->contract_type = $request->contract_type;
        $offer->annual_salary_minumun = $request->annual_salary_minumun;
        $offer->annual_salary_maximun = $request->annual_salary_maximun;
        $offer->advantages = $request->advantages;
        $offer->city = $request->city;
        $offer->location = $request->location;
        $offer->experience = $request->experience;
        $offer->languages_required = $request->languages_required;
        if ($request->active === "on") {
            $offer->active = 1;
        } else {
            $offer->active = 0;
        }
        $offer->save();

        return redirect()->route('dashboard.offer', [$offer->slug, $offer->id])->with('success', 'Offre modifiée avec succès');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $contract_type = $request->input('contract_type');
        $location = $request->input('location');
        $localisation = $request->input('localisation');
        $company = $request->input('company');

        $offers = CompanyOffer::query();

        if (!empty($query)) {
            $offers = $offers->where('title', 'like', "%{$query}%");
        }

        if (!empty($contract_type)) {
            $offers = $offers->where('contract_type', $contract_type);
        }

        if (!empty($location)) {
            $offers = $offers->where('location', $location);
        }

        if (!empty($localisation)) {
            $offers = $offers->where('city', 'like', "%{$localisation}%");
        }

        if (!empty($company)) {
            $offers = $offers->whereHas('company', function ($query) use ($company) {
                $query->where('company_name', 'like', "%{$company}%");
            });
        }

        $offers = $offers->get();

        if(\auth()->user() && \auth()->user()->role === 'company') {
            return view('dashboard.offers.search', [
                'offers' => $offers,
                'query' => $query,
                'contract_type' => $contract_type,
                'location' => $location,
                'localisation' => $localisation,
                'company' => $company
            ]);
        }else if (\auth()->user() && \auth()->user()->role === 'admin') {
            return view('admin.offers', [
                'offers' => $offers,
            ]);
        }
    }

    public function apply(OfferApplyRequest $request)
    {
        if (Auth::user()->role === 'company') {
            return redirect()->back()->with('error', 'Vous ne pouvez pas postuler à une offre en tant qu\'entreprise');
        }

        $hasApplied = \App\Models\ApplyOffer::where('user_id', Auth::user()->id)
            ->where('offer_id', $request->offer_id)
            ->exists();

        if($hasApplied) {
            return redirect()->back()->with('error', 'Vous avez déjà postulé à cette offre');
        }

        $apply = new ApplyOffer();
        $apply->offer_id = $request->offer_id;
        $apply->user_id = Auth::user()->id;
        $apply->message = $request->message;
        $apply->status = 'pending';
        $apply->company_id = CompanyOffer::find($request->offer_id)->company->id;

        if ($request->hasFile('curriculum')) {
            $curriculum = $request->file('curriculum');
            $filename = time() . '.' . $curriculum->getClientOriginalExtension();
            $curriculum->move(public_path('uploads/curriculums'), $filename);
            $apply->curriculum = 'uploads/curriculums/' . $filename;
        }

        if ($request->hasFile('cover_letter')) {
            $cover_letter = $request->file('cover_letter');
            $filename = time() . '.' . $cover_letter->getClientOriginalExtension();
            $cover_letter->move(public_path('uploads/cover_letters'), $filename);
            $apply->cover_letter = 'uploads/cover_letters/' . $filename;
        }

        $apply->save();

        $offer = CompanyOffer::find($request->offer_id);

        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'ssl0.ovh.net';
            $mail->Port = '465';
            $mail->isHTML(true);
            $mail->Username = "contact@maplaque-nfc.fr";
            $mail->Password = "3v;jcPFeUPMBCP9";
            $mail->SetFrom("contact@maplaque-nfc.fr", "MonOffreD'emploi.fr");
            $mail->Subject = 'Merci pour votre candidature !';
            $offer = CompanyOffer::find($request->offer_id);

            $mail->Body = '<h1>Merci pour votre candidature à l\'offre ' . $offer->title . ' chez ' . $offer->company->company_name . '</h1>
            <p>Nous avons bien reçu votre candidature. Vous pouvez suivre l\'état d\'avancement depuis votre espace.</p>
            <p>Voici les détails de l\'offre à laquelle vous avez postulé :</p>
            <p>Titre de l\'offre : ' . $offer->title . '</p>
            <p>Description : ' . $offer->description . '</p>
            <p>Type de contrat : ' . $offer->contract_type . '</p>
            <p><a href="' . url('/entreprise/offre/' . $offer->slug . '/' . $offer->id) . '">Cliquez ici</a> pour voir l\'offre.</p>';
            $mail->AddAddress(Auth::user()->email);
            $mail->Send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        try {
            $mailCompany = new PHPMailer();
            $mailCompany->isSMTP();
            $mailCompany->SMTPAuth = true;
            $mailCompany->SMTPSecure = 'ssl';
            $mailCompany->Host = 'ssl0.ovh.net';
            $mailCompany->Port = '465';
            $mailCompany->isHTML(true);
            $mailCompany->Username = "contact@maplaque-nfc.fr";
            $mailCompany->Password = "3v;jcPFeUPMBCP9";
            $mailCompany->SetFrom("contact@maplaque-nfc.fr", "MonOffreD'emploi.fr");
            $mailCompany->Subject = 'Nouvelle candidature pour l\'offre ' . $offer->title;
            $mailCompany->Body = '<h1>Nouvelle candidature pour l\'offre ' . $offer->title . '</h1>
            <p>Vous avez reçu une nouvelle candidature de ' . Auth::user()->name . '.</p>
            <p>Email: ' . Auth::user()->email . '</p>
            <p>Message: ' . $request->message . '</p>
            <p>CV : <a href="' . url('/' . $apply->curriculum) . '">Cliquez ici</a> pour voir le CV.</p>
            <p>Lettre de motivation : <a href="' . url('/' . $apply->cover_letter) . '">Cliquez ici</a> pour voir la lettre de motivation.</p>';
            $mailCompany->AddAddress($offer->company->company_email);
            $mailCompany->Send();
        } catch (Exception $e) {
            // Handle the exception
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        return redirect()->back()->with('success', 'Votre candidature a bien été envoyée');
    }

    public function updateStatus(Request $request, $id)
    {
        $offer = ApplyOffer::findOrFail($id);
        $offer->status = $request->input('status');
        $offer->save();

        return back()->with('success', 'Le statut de l\'offre a été mis à jour avec succès.');
    }

    public function addFavoriteOffer($id)
    {
        $offer = CompanyOffer::find($id);
        if (!$offer) {
            return redirect()->back()->with('error', 'Offre non trouvée');
        }

        Auth::user()->favoriteOffers()->attach($id);

        return redirect()->back()->with('success', 'Offre ajoutée aux favoris');
    }

    public function removeFavoriteOffer($id)
    {
        $offer = CompanyOffer::find($id);
        if (!$offer) {
            return redirect()->back()->with('error', 'Offre non trouvée');
        }

        Auth::user()->favoriteOffers()->detach($id);

        return redirect()->back()->with('success', 'Offre retirée des favoris');
    }
}
