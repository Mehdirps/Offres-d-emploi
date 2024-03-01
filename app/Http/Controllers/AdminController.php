<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use App\Models\Company;
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

        return view('admin.companies',[
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

        if(!auth()->user()->role === 'admin') {
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

        if($request->hasFile('logo')) {
            if($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }

            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/logos'), $filename);
            $company->logo = 'uploads/logos/' . $filename;
        }

        if($request->hasFile('banner')) {
            if($company->banner && file_exists(public_path($company->banner))) {
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

    public function offers()
    {
        $offers = CompanyOffer::paginate(15);

        return view('admin.offers',[
            'offers' => $offers
        ]);
    }
}
