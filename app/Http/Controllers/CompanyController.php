<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return view('company/index', [
            'companies' => $companies
        ]);
    }

    public function single($id)
    {
        $company = Company::find($id);
        $offers = $company->offers;

        return view('company/single', [
            'company' => $company,
            'offers' => $offers
        ]);
    }

    public function update($id, Request $request)
    {
        $company = Company::find($id);

        if($company->user_id != auth()->user()->id) {
            return redirect()->route('dashboard.company');
        }

        $company->name = $request->name;
        $company->description = $request->description;
        $company->activity = $request->activity;
        $company->address = $request->address;
        $company->postal_code = $request->postal_code;
        $company->city = $request->city;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->website = $request->website;

        if($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'mimes:png,jpg,jpeg,webp|max:2048',
            ]);

            if($company->logo && file_exists(public_path($company->logo))) {
                unlink(public_path($company->logo));
            }

            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/logos'), $filename);
            $company->logo = 'uploads/logos/' . $filename;
        }

        if($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'mimes:png,jpg,jpeg,webp|max:2048',
            ]);

            if($company->banner && file_exists(public_path($company->banner))) {
                unlink(public_path($company->banner));
            }

            $banner = $request->file('banner');
            $filename = time() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('uploads/banners'), $filename);
            $company->banner = 'uploads/banners/' . $filename;
        }

        $company->save();

        return redirect()->route('dashboard.company');
    }

}
