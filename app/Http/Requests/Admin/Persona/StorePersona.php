<?php

namespace App\Http\Requests\Admin\Persona;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePersona extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.persona.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'apellidos' => ['required', 'string'],
            'direccion' => ['required', 'string'],
            'email' => ['nullable', 'email', 'string'],
            'identificacion' => ['required', 'string'],
            'nombres' => ['required', 'string'],
            'representante_persona_id' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'telefono' => ['nullable', 'string'],
            'tipo_documento_id' => ['required', 'integer'],
            
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
