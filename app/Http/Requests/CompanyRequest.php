<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        // Bisa diubah sesuai kebutuhan, default true agar validasi jalan
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $this->company, // unik kecuali untuk data company yang sedang diupdate
            'phone' => 'required|numeric|digits_between:10,15',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // max 2MB
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

//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return false;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
//      */
//     public function rules(): array
//     {
//         return [
//             //
//         ];
//     }
// }