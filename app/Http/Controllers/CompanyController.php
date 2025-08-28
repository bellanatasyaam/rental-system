<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Http\Requests\CompanyRequest; // Ganti Request biasa ke CompanyRequest
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->only(['name','address','phone','email','tax_number']);
        Company::create($data);

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->only(['name','address','phone','email','tax_number']);
        $company->update($data);

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