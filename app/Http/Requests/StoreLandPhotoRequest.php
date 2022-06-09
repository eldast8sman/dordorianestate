<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLandPhotoRequest extends FormRequest
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
            'land_id' => 'required|integer|exists:\App\Models\Land,id',
            'filepath' => 'required|mimes:jpg,jpeg,png,gif|max:500',
            'caption' => 'string'
        ];
    }
}
