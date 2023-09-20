<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
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
            'name_ar' => 'required_if:name_en,null',
            'name_en' => 'required_if:name_ar,null',
            'name_ku'=>'required_if:name_ar,null',
            'name_tr'=>'required_if:name_ar,null',
            'image'=>'required_if:name_en,null',
            'text_ar' => 'required_if:text_en,null',
            'text_en' => 'required_if:text_ar,null',
            'text_ku'=>'required_if:text_en,null',
            'text_tr'=>'required_if:text_en,null',
            'price'=>'required_if:name_en,null|numeric',
            'category_id'=>'required_if:name_en,null',
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
        return
        [
            'name_ar.required_if'=>trans('validation.required_if'),
            'name_en.required_if'=>trans('validation.required_if'),
            'name_ku.required_if'=>trans('validation.required_if'),
            'name_tr.required_if'=>trans('validation.required_if'),
            'text_ar.required_if'=>trans('validation.required_if'),
            'text_en.required_if'=>trans('validation.required_if'),
            'text_ku.required_if'=>trans('validation.required_if'),
            'text_tr.required_if'=>trans('validation.required_if'),
            'image.required_if'=>trans('validation.required_if'),
            'price.required_if'=>trans('validation.required_if'),
            'price.numeric'=>trans('validation.numeric'),
            'category_id.required_if'=>trans('validation.required_if'),
        ];
    }
}
