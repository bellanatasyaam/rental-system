<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true; // biar request bisa dijalankan
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('companies')->ignore($this->company->id ?? null), // ignore company yang sedang diupdate
            ],
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'nullable|string',
            'tax_number' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama perusahaan harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.numeric' => 'Nomor telepon harus berupa angka.',
            'phone.digits_between' => 'Nomor telepon harus antara 10 sampai 15 digit.',
        ];
    }
}
