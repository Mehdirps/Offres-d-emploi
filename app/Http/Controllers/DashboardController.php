<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard/index');
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
        $company = Company::find(Auth::user()->id);
        $offers = CompanyOffer::where('company_id', $company->id)->get();

        return view('dashboard/offers', [
            'offers' => $offers,
        ]);
    }

    public function viewSingleOfferByCompany($id)
    {
        $offer = CompanyOffer::where('id', $id)->first();

        return view('dashboard/offer', [
            'offer' => $offer,
        ]);
    }
}
