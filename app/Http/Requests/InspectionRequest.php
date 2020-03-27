<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InspectionRequest extends FormRequest
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
            'date' => 'required|date',
            'queen_seen' => 'boolean',
            'larval_seen' => 'boolean',
            'young_larval_seen' => 'boolean',
            'pollen_arriving' => 'integer|min:0|max:100',
            'comb_building' => 'integer|min:0|max:100',
            'notes' => 'max:2000',
            'hive_id' => 'required'
        ];
    }
}
