<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MateriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Menentukan apakah pengguna boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        // Hanya pengguna dengan role 'pengajar' yang boleh membuat/update materi
        return Auth::user()->role === 'pengajar';
    }

    /**
     * Get the validation rules that apply to the request.
     * Mendapatkan aturan validasi untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link_video' => ['required', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/'],
            'file_pendukung' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // max 10MB
        ];
    }
}