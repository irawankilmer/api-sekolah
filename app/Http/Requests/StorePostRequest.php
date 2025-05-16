<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'umail'     => 'required',
            'password'   => 'required'
        ];
    }

    public function messages(): array
    {
      return [
          'umail.required' => 'Kolom Username atau Email harus diisi',
          'password.required' => 'Kolom Password harus diisi'
      ];
    }
}
