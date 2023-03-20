<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createProductRequest extends FormRequest
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
            'title'=>'required',
            'quantity'=>'required',
            'description'=>'required' ,
            'price'=>'required' ,
            'tax'=>'required' ,
            'qty'=>'required',
            'attachment'=>'required' ,
            'category_id'=>'required|exists:categories,id',
        ];
    }
   
    public function messages()
{
    return [
        'tax.required' => 'the discount field is required',
        'attachment.required'=> 'the image field is required',
        'category_id.required'=> 'the category field is required',
    ];
}
}