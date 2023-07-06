<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'required',
            'description' => 'required',
            'visible' => 'required',
            'category' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'price.required' => 'Il campo prezzo è obbligatorio.',
            'price.numeric' => 'Il campo prezzo deve essere un valore numerico.',
            'price.min' => 'Il campo prezzo deve essere superiore a :min.',
            'image.required' => 'Il campo immagine è obbligatorio.',
            'description.required' => 'Il campo descrizione è obbligatorio.',
            'visible.required' => 'Il campo visibilità è obbligatorio.',
            'category.required' => 'Il campo categoria è obbligatorio.',
        ];
    }
}
