<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return view('company/index', [
            'companies' => $companies
        ]);
    }

    public function single($slug, $id)
    {
        $company = Company::find($id);
        $offers = $company->offers;

        if (!$company->active) {
            return redirect()->route('companies');
        } else {
            return view('company/single', [
                'company' => $company,
                'offers' => $offers
            ]);
        }
    }

    public function update($id, CompanyRequest $request)
    {
        $company = Company::find($id);

        if ($company->user_id != auth()->user()->id) {
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

        $company->save();

        return redirect()->route('dashboard.company')->with('success', 'Les informations de votre entreprise ont bien été mises à jour.');
    }

}
