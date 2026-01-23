<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJourneyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'image' => 'nullable|url',
            // Immagini opzionali in update
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5000',
            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string',
            'excludes' => 'nullable|array',
            'excludes.*' => 'nullable|string',
            'itinerary' => 'nullable|array',
            'itinerary.*.title' => 'required_with:itinerary|string',
            'itinerary.*.description' => 'required_with:itinerary|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'description.required' => 'La descrizione è obbligatoria.',
            'price.required' => 'Il prezzo è obbligatorio.',
            'duration_days.required' => 'La durata è obbligatoria.',
            'image.url' => 'L\'immagine deve essere un URL valido.',
            'images.array' => 'Le immagini devono essere un array.',
            'images.*.image' => 'Il file deve essere un\'immagine.',
            'images.*.mimes' => 'I formati supportati sono: jpeg, png, jpg, gif, webp.',
            'images.*.max' => 'L\'immagine non può superare i 5MB.',
        ];
    }
}
