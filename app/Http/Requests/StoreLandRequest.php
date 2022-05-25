<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandRequest extends FormRequest
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
            'state' => 'required|string|max:200',
            'lga' => 'required|string|max:200',
            'area' => 'required|string',
            'description' => 'required|string',
            'size' => 'required|string',
            'available_plots' => 'required|integer',
            'price' => 'required|numeric'
        ];
    }
}
