<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCategoryRequest extends FormRequest
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
        'edit.description'  => 'string',
        'edit.parent_id'  => ['nullable', 'string']
      ];
    }

    return [
      'name' => 'required',
    ];
  }

  public function messages(): array
  {
    return [
      'name'  => 'Kolom nama Kategori tidak boleh kosong',
      'edit.name'  => 'Kolom nama Kategori tidak boleh kosong',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      redirect()
        ->back()
        ->withErrors($validator)
        ->withInput()
        ->with('edit_category_id', $this->route('id'))
    );
  }
}
