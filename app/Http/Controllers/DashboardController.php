<?php

namespace App\Http\Controllers;

use App\Models\ApplyOffer;
use App\Models\Company;
use App\Models\CompanyOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $company = Company::where('user_id', Auth::user()->id)->first();

        return view('dashboard/index',[
            'company' => $company
        ]);
    }

    public function viewCompany()
    {
        $company = Company::where('user_id', Auth::user()->id)->first();
        return view('dashboard/company', [
            'company' => $company
        ]);
    }

    public function viewOffersByCompany()
    {
        $company = Company::find(Auth::user()->company->id);
        $offers = CompanyOffer::where('company_id', $company->id)->get();

        return view('dashboard/offers', [
            'offers' => $offers,
        ]);
    }

    public function viewSingleOfferByCompany($slug, $id)
    {
        $offer = CompanyOffer::where('id', $id)->first();

        return view('dashboard/offer', [
            'offer' => $offer,
        ]);
    }

    public function offerApply()
    {
        $company = Company::find(Auth::user()->company->id);
        $apply = ApplyOffer::where('company_id', $company->id)->get();
        $offers = $company->offers;

        return view('dashboard/offer_apply', [
            'apply' => $apply,
            'offers' => $offers,
        ]);
    }
}
