<?php

namespace App\Http\Requests;

use App\Helpers\UnitSystemHelper;
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
        if(!auth()->user()->uses_metric) {
            $this->request->set('weight', UnitSystemHelper::calculateKg($this->request->get('weight')));
        }

        return [
            'name' => 'required|max:255',
            'date' => 'required|date',
            'batch_code' => 'required|max:255',
            'weight' => 'required|numeric|min:0|max:100000',
            'moister_content' => 'required|integer|min:0|max:100',
            'nectar_source' => 'required|max:255',
            'description' => 'nullable',
            'hive_id' => 'array'
        ];
    }
}
