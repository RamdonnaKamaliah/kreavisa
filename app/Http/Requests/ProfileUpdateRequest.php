<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
           'email' => [
            'required', 
            'string', 
            'email', 
            'max:255', 
            Rule::unique(User::class)->ignore($this->user()->id),
            'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i'
        ],
            'no_telepon' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'tanggal_lahir' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];

        // Hanya validasi password jika diisi
        if ($this->filled('password')) {
            $rules['current_password'] = ['required', 'current_password'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    public function messages()
{
    return [
        'email.regex' => 'Email harus menggunakan alamat Gmail (@gmail.com)',
        // ... pesan error lainnya
    ];
}

    protected function prepareForValidation()
    {
        if ($this->tanggal_lahir) {
            $this->merge([
                'usia' => $this->calculateAge($this->tanggal_lahir),
            ]);
        }
    }

    private function calculateAge($birthDate)
    {
        $birthDate = new \DateTime($birthDate);
        $today = new \DateTime();
        return $today->diff($birthDate)->y;
    }
}