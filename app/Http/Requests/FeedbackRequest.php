<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FeedbackRequest extends FormRequest
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

            'comment'=>'required',
            'rating_service'=>'required',
            'rating_hygiene'=>'required',
            'rating_staff'=>'required',
            'email'=>'email|nullable|unique:feedback,email,except,id',
            'phone'=>'nullable|number|unique:feedback,email,except,id'
        ];
    }

    public function messages()
    {
        return [
            'comment.required'=>__('validation.required'),
            'rating_service.required'=>__('rating_service.required'),
            'rating_hygiene.required'=>__('rating_hygiene.required'),
            'rating_staff.required'=>__('rating_staff.required'),
            'email.email'=>__('email.email'),
            'email.unique'=>__('email.unique'),
            'phone.unique'=>__('phone.unique'),
            'phone.string'=>__('phone.string'),
        ];
    }


}
