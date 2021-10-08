<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddItemRequest extends FormRequest
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
            'name'=>'string|required',
            'year'=>'numeric|required',
            'description'=>'string|required',
            'price'=>'required|numeric',
            'option_id'=>'required|numeric',
            'rent_id'=>'required|numeric',
            'brand_id'=>'required',
            'category_id'=>'required',
            'city_id'=>'required',
        ];
    }
}
