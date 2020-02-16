<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiaryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'apiary_image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
