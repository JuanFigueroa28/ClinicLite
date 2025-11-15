<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorHoursRequest extends FormRequest
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
        // Reglas de validación para creación y edición de horarios.
        // Para creación (POST): se requiere selección de múltiples días y rango de fechas.
        // Para edición (PUT/PATCH): los campos de hora y duración son opcionales ("sometimes") para permitir actualizaciones parciales.
        $days = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

        if ($this->isMethod('post')) {
            return [
                'doctor_id' => ['required', 'integer'],
                'week_days' => ['required', 'array', 'min:1'],
                'week_days.*' => ['string', Rule::in($days)],
                'start_date' => ['required', 'date', 'after_or_equal:today'],
                'end_date' => ['required', 'date', 'after:start_date'],
                'start_time' => ['required', 'date_format:H:i'],
                'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
                'duration_minutes' => ['required', 'integer', 'min:5'],
            ];
        }

        return [
            'doctor_id' => ['sometimes', 'integer'],
            'week_day' => ['sometimes', 'string', Rule::in($days)],

            'start_time' => ['sometimes', 'nullable', 'date_format:H:i'],
            'end_time' => ['sometimes', 'nullable', 'date_format:H:i'],
            'duration_minutes' => ['sometimes', 'nullable', 'integer', 'min:5'],
        ];
    }

public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if ($this->isMethod('post')) return;

        // Validación adicional solo cuando se envían ambas horas.
        // Permite que editar solo inicio o solo fin pase sin bloquear.
        $hasStart = $this->filled('start_time');
        $hasEnd   = $this->filled('end_time');

        // Solo validar si el usuario envió AMBOS
        if ($hasStart && $hasEnd) {

            // Comparación en minutos para evitar problemas de formato.
            [$sh, $sm] = array_map('intval', explode(':', $this->start_time));
            [$eh, $em] = array_map('intval', explode(':', $this->end_time));

            if ($eh * 60 + $em <= $sh * 60 + $sm) {
                $validator->errors()->add('end_time', 'La hora de fin debe ser mayor que la hora de inicio');
            }
        }
    });
}

}
