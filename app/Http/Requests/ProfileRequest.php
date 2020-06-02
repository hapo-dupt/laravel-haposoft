<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z ]+$/|max:50',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|min:3|max:10|confirmed'
        ];
    }
}
