<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255|min:6',
            'slogan' => 'required',
            'description' => 'required',
            'image_path'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be empty',
            'slogan.required' => 'Slogan cannot be empty',
            'description.required' => 'Description cannot be empty',
            'name.unique' => 'Name cannot be duplicate',
            'name.max' => 'Name cannot be more than 255 characters',
            'name.min' => 'Name cannot be less than 10 characters',
            'image_path' => 'Image cannot be empty',
        ];
    }
}
