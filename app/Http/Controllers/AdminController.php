<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\CompanyOffer;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function companies()
    {
        $companies = Company::paginate(15);

        return view('admin.companies', [
            'companies' => $companies
        ]);
    }

    public function singleCompany($id)
    {
        $company = Company::find($id);

        return view('admin.crud.update_company', [
            'company' => $company
        ]);
    }

    public function updateCompany($id, CompanyRequest $request)
    {
        $company = Company::find($id);

        if (!auth()->user()->role === 'admin') {
            return redirect()->route('dashboard.company');
        }

        $company->company_name = $request->company_name;
        $company->slug = Str::slug($request->company_name, '-');
        $company->description = $request->description;
        $company->activity = $request->activity;
        $company->address = $request->address;
        $company->postal_code = $request->postal_code;
        $company->city = $request->city;
        $company->company_phone = $request->company_phone;
        $company->company_email = $request->company_email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            if ($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }

            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/logos'), $filename);
            $company->logo = 'uploads/logos/' . $filename;
        }

        if ($request->hasFile('banner')) {
            if ($company->banner && file_exists(public_path($company->banner))) {
                unlink(public_path($company->banner));
            }

            $banner = $request->file('banner');
            $filename = time() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/banners'), $filename);
            $company->banner = 'uploads/banners/' . $filename;
        }
        $company->active = $request->active;

        $company->save();

        return redirect()->route('admin.companies')->with('success', 'Les informations de votre entreprise ont bien été mises à jour.');
    }

    public function deleteCompany($id)
    {
        $company = Company::find($id);

        if (!auth()->user()->role === 'admin') {
            return redirect()->route('dashboard.company');
        }

        if ($company->logo && file_exists(public_path($company->logo))) {
            unlink(public_path($company->logo));
        }

        if ($company->banner && file_exists(public_path($company->banner))) {
            unlink(public_path($company->banner));
        }

        if ($company->offers) {
            foreach ($company->offers as $offer) {
                if ($offer->logo && file_exists(public_path($offer->logo))) {
                    unlink(public_path($offer->logo));
                }

                if ($offer->apply) {
                    foreach ($offer->apply as $apply) {

                        if ($apply->curriculum && file_exists(public_path($apply->curriculum))) {
                            unlink(public_path($apply->curriculum));
                        }

                        if ($apply->cover_letter && file_exists(public_path($apply->cover_letter))) {
                            unlink(public_path($apply->cover_letter));
                        }

                        $apply->delete();
                    }
                }

                $offer->delete();
            }
        }

        $company->delete();

        return redirect()->route('admin.companies')->with('success', 'Entreprise supprimée avec succès');
    }

    public function offers()
    {
        $offers = CompanyOffer::paginate(15);

        return view('admin.offers', [
            'offers' => $offers
        ]);
    }

    public function singleOffer($id)
    {
        $offer = CompanyOffer::find($id);

        return view('admin.crud.update_offer', [
            'offer' => $offer
        ]);
    }

    public function updateOffer($id, Request $request)
    {
        $offer = CompanyOffer::find($id);

        if (!auth()->user()->role === 'admin') {
            return redirect()->route('dashboard.company');
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
        $offer->active = $request->active;

        $offer->save();

        return redirect()->route('admin.offers')->with('success', 'Offre modifiée avec succès');

    }

    public function deleteOffer($id)
    {
        $offer = CompanyOffer::find($id);

        if (!auth()->user()->role === 'admin') {
            return redirect()->route('dashboard.company');
        }

        if ($offer->apply) {
            foreach ($offer->apply as $apply) {

                if ($apply->curriculum && file_exists(public_path($apply->curriculum))) {
                    unlink(public_path($apply->curriculum));
                }

                if ($apply->cover_letter && file_exists(public_path($apply->cover_letter))) {
                    unlink(public_path($apply->cover_letter));
                }

                $apply->delete();
            }
        }

        $offer->delete();

        return redirect()->route('admin.offers')->with('success', 'Offre supprimée avec succès');
    }

}
