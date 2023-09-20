<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AdminRequest extends FormRequest
{
    use ResponseTrait;
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
            'owner_name' => 'required',
            'password' => 'required|min:3',
            'address' => 'required|string',
            'restaurant_code' => 'required|unique:admins,restaurant_code,except,id',
            'facebook' => 'required_if:owner_name,null|url',
            'insta' => 'required_if:owner_name,null|url',
            'snapchat' => 'required_if:owner_name,null|url',
            'phone_restaurant' => 'required_if:owner_name,null',
            'phone_owner' => 'required_if:owner_name,null',
            'email' => 'email|required_if:owner_name,null|unique:admins,email,except,id',
            'theme_id' => 'required',
            'image' => 'required',
            'subscription_id' => 'required',
            'start_reg' => 'required',
            'end_reg' => 'required'
        ];
    }
    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ]));
    }

    public function messages()
    {
        return [
            'owner_name.required'=>__('validation.required'),
            'password.required'=>__('validation.required'),
            'password.min'=>__('validation.min'),
            'restaurant_code.required'=>__('validation.required'),
            'address.required'=>__('validation.required'),
            'address.string'=>__('validation.string'),
            'restaurant_code.unique'=>__('validation.unique'),
            'facebook.required_if'=>__('validation.required_if'),
            'facebook.url'=>__('validation.url'),
            'insta.required_if'=>__('validation.required_if'),
            'insta.url'=>__('validation.url'),
            'snapchat.required_if'=>__('validation.required_if'),
            'snapchat.url'=>__('validation.url'),
            'phone_restaurant.required_if'=>__('validation.required_if'),
            'phone_owner.required_if'=>__('validation.required_if'),
            'email.required_if'=>__('validation.required_if'),
            'email.email'=>__('validation.email'),
            'email.unique'=>__('validation.unique'),
            'theme_id.required'=>__('validation.required'),
            'subscription_id.required'=>__('validation.required'),
            'image.required'=>__('validation.required'),
            'start_reg.required'=>__('validation.required'),
            'end_reg.required'=>__('validation.required'),
        ];
    }
}
