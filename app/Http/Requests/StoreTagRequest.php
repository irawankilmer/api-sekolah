<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTagRequest extends FormRequest
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
      if ($this->has('edit')) {
        return [
          'edit.name' => 'required',
          'edit.description'  => 'string'
        ];
      }

        return [
          'name' => 'required',
        ];
    }

    public function messages(): array
    {
      return [
        'name'  => 'Kolom nama tag tidak boleh kosong',
        'edit.name'  => 'Kolom nama tag tidak boleh kosong',
      ];
    }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      redirect()
        ->back()
        ->withErrors($validator)
        ->withInput()
        ->with('edit_tag_id', $this->route('id'))
    );
  }
}
