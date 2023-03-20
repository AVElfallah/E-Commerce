<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'governorate_id'=>'required|unique:shipping_cost,governorate_id,'.$this->id ,
            'cost'=>'required' ,
        ];
    }

    public function messages()
    {
        return [
            'governorate_id.unique'=> 'The governorate has already been taken.',
        ];
    }
}
