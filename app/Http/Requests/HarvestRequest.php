<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HarvestRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'date' => 'required|date',
            'batch_code' => 'required|max:255',
            'weight' => 'required|integer',
            'moister_content' => 'required|integer',
            'nectar_source' => 'required|max:255',
            'description' => 'nullable',
            'hive_id' => 'array'
        ];
    }
}
