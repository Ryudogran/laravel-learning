<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'email' =>'email|nullable',
            'logo' =>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=100,min_height=100|nullable',
            'website' => 'url|nullable'
        ];
    }
}
