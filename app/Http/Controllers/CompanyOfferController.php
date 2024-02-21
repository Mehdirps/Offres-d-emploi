<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\CompanyOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $offers = CompanyOffer::where('title', 'like', "%{$query}%")->get();

        return view('offers.search', [
            'offers' => $offers,
            'query' => $query
        ]);
    }
}
