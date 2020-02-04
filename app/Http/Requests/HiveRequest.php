<?php

namespace App\Http\Requests;

use App\HiveType;
use Illuminate\Foundation\Http\FormRequest;

class HiveRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hiveTypes->contains('id', $this->input('hive_type_id')) || $this->input('hive_type_id') === null;
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
            'apiary_id' => 'required',
            'hive_type_id' => 'required'
        ];
    }
}
