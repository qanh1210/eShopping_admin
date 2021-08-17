<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'contents'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty',
            'price.required' => 'Price cannot be empty',
            'name.unique' => 'Name cannot be duplicate',
            'name.max' => 'Name cannot be more than 255 characters',
            'name.min' => 'Name cannot be less than 10 characters',
            'category_id' => 'Category cannot be empty',
            'contents.required' => 'Content cannot be empty'
        ];
    }
}
