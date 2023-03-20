<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createCardRequest extends FormRequest
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
                'description'=>'required' ,
                'attachment'=>'required' ,
        ];
    }

    public function messages()
        {
            return [
                'attachment.required'=> 'the image field is required',
            ];
        }
}