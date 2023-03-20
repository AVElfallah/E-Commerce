<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createSettingRequest extends FormRequest
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
            'footer_desc'=>'required',
            'fb_link'=>'required',
            'insta_link'=>'required',
            'tw_link'=>'required',
            'you_link'=>'required',
            'wha_link'=>'required',
           
        ];
    }

}
