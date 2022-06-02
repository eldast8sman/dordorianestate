<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'heading' => 'required|string|max:255',
            'sub_heading' => 'string|max:255',
            'body' => 'required|string',
            'author' => 'required|string|max:500',
            'filepath' => 'mimes:jpg,jpeg,png'
        ];
    }
}
