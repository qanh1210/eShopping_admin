<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class ResetPasswordRequest extends FormRequest
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
//            'token' => 'required',
            'password'=> 'required',
            'confirm_password' => 'required | same:password'
        ];
    }

     public function messages()
     {
         return [
             'password.required' => 'Password is required',
             'confirm_password.required' => 'Please confirm your password',
             'confirm_password.same' => 'Your confirmation password does not match'
         ];
     }
}
