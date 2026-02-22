<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'username' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'name' => ['nullable', 'string', 'max:255'],
        'title' => ['nullable', 'string', 'max:255'],
        'bio' => ['nullable', 'string'],
        'photo' => ['nullable', 'image', 'max:2048'],
        'cv' => ['nullable', 'mimes:pdf', 'max:4096'],
    ];
}

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'title.string' => 'Title harus berupa teks.',
            'title.max' => 'Title tidak boleh lebih dari 255 karakter.',
            'bio.string' => 'Bio harus berupa teks.',
            'photo.image' => 'Foto harus berupa gambar (jpeg, png, bmp, gif, svg).',
            'photo.max' => 'Foto tidak boleh lebih dari 2MB.',
            'cv.mimes' => 'CV harus berupa file PDF.',
            'cv.max' => 'CV tidak boleh lebih dari 4MB.',
        ];
    }
}
