<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJourneyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorizziamo tutti per ora (demo)
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
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:25000',
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
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'description.required' => 'La descrizione è obbligatoria.',
            'price.required' => 'Il prezzo è obbligatorio.',
            'price.numeric' => 'Il prezzo deve essere un numero.',
            'price.min' => 'Il prezzo non può essere negativo.',
            'duration_days.required' => 'La durata è obbligatoria.',
            'duration_days.integer' => 'La durata deve essere un numero intero.',
            'duration_days.min' => 'La durata deve essere di almeno 1 giorno.',
            'images.required' => 'Devi caricare almeno un\'immagine.',
            'images.array' => 'Le immagini devono essere un array.',
            'images.min' => 'Carica almeno un\'immagine.',
            'images.*.image' => 'Il file deve essere un\'immagine.',
            'images.*.mimes' => 'I formati supportati sono: jpeg, png, jpg, gif, webp.',
            'images.*.max' => 'L\'immagine non può superare i 25MB.',
            'itinerary.*.title.required_with' => 'Il titolo della tappa è obbligatorio.',
            'itinerary.*.description.required_with' => 'La descrizione della tappa è obbligatoria.',
        ];
    }
}
