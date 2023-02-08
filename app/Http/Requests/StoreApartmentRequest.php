<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'image' => ['required', 'max:500'],
            'longitude' => ['required'],
            'latitude' => ['required'],
            'visibility' => ['nullable'],
            'services' => ['exists:services,id']
        ];
    }
}
