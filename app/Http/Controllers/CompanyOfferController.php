<?php

namespace App\Http\Controllers;

use App\Models\CompanyOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyOfferController extends Controller
{
    public function single($id)
    {
        $offer = CompanyOffer::find($id);
        $company = $offer->company;

        return view('offer/index',[
            'offer' => $offer,
            'company' => $company
        ]);
    }
}
