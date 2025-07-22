<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'string|required',
            'deskripsi' => 'nullable|string',
            'tanggal_event' => 'required|date|after_or_equal:today'
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul wajib diisi',
            'judul.string' => 'Judul harus berupa teks',

            'deskripsi.string' => 'Deskripsi harus berupa teks',

            'tanggal_event.required' => 'Tanggal event wajib diisi.',
            'tanggal_event.date' => 'Format tanggal tidak valid.',
            'tanggal_event.after_or_equal' => 'Tanggal event tidak boleh sebelum hari ini.',
        ];
    }

}
