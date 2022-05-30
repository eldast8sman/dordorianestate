<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInspectionVisitRequest extends FormRequest
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
           'name' => 'required|string|max:500',
           'phone' => 'required|string|max:20',
           'email' => 'string|max:500',
           'land_id' => 'required|integer|exists:\App\Models\Land,id',
           'inspection_date' => 'required|string',
           'inspection_time' => 'required|string' 
        ];
    }
}
