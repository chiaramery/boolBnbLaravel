<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:200'],
            'rooms' => ['required'],
            'beds' => ['required'],
            'bathrooms' => ['required'],
            'square_meters' => ['required'],
            'address' => ['required', 'max:150'],
            'image' => ['nullable'],
            'visibility' => ['nullable'],
            'services' => ['required', 'exists:services,id'],
            'user_id' => ['nullable', 'exists:users,id']
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Inserisci il titolo',
            'rooms.required' => 'Inserisci il numero di stanze',
            'beds.required' => 'Inserisci il numero di letti',
            'bathrooms.required' => 'Inserisci il numero di bagni',
            'square_meters.required' => 'Inserisci il valore dei metri quadrati',
            'address.required' => "Inserisci l'indirizzo",
            'image.required' => "Inserisci l'immagine",
            'services' => "Inserisci almeno un servizio"
        ];
    }
}
