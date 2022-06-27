<?php

namespace App\Http\Requests\Admin\Persona;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePersona extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.persona.edit', $this->persona);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'apellidos' => ['sometimes', 'string'],
            'direccion' => ['sometimes', 'string'],
            'email' => ['nullable', 'email', 'string'],
            'identificacion' => ['sometimes', 'string'],
            'nombres' => ['sometimes', 'string'],
            'representante_persona_id' => ['nullable', 'string'],
            'status' => ['sometimes', 'boolean'],
            'telefono' => ['nullable', 'string'],
            'tipo_documento_id' => ['sometimes', 'integer'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
