<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
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
            'client_id' => 'required|integer|exists:clients,id',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve contenere del testo.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'client_id.required' => 'Il cliente è obbligatorio.',
            'client_id.integer' => 'Il cliente selezionato non è valido.',
            'client_id.exists' => 'Il cliente selezionato non esiste.',
            'description.string' => 'La descrizione deve contenere del testo.',
            'start_time.required' => 'La data e l’ora di inizio sono obbligatorie.',
            'start_time.date' => 'La data e l’ora di inizio non sono valide.',
            'end_time.required' => 'La data e l’ora di fine sono obbligatorie.',
            'end_time.date' => 'La data e l’ora di fine non sono valide.',
            'end_time.after' => 'La data e l’ora di fine devono essere successive a quelle di inizio.',
        ];
    }
}
