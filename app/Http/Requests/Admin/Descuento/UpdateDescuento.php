<?php

namespace App\Http\Requests\Admin\Descuento;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateDescuento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.descuento.edit', $this->descuento);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'descripcion' => ['sometimes', 'string'],
            'grado_id' => ['sometimes', 'string'],
            'max' => ['sometimes', 'string'],
            'min' => ['sometimes', 'string'],
            'status' => ['sometimes', 'boolean'],
            'valor' => ['sometimes', 'numeric'],
            
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
