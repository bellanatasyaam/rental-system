<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Http\Requests\CompanyRequest; // Ganti Request biasa ke CompanyRequest

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        // return CompanyResource::collection(Company::paginate(10));
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
            if ($request->hasFile('logo')) {
                $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($data);

        // $request->validate([
        //     'name' => 'required|string|max:255'
        // ]);

        // Company::create($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
        // Hapus file lama jika ada
            if ($company->logo && \Storage::disk('public')->exists($company->logo)) {
            \Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        // $request->validate([
        //     'name' => 'required|string|max:255'
        // ]);

        // $company->update($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['success' => true]);
    }

        public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    // Tambahkan method store, update, destroy jika perlu

}