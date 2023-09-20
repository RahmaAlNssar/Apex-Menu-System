<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class OfferRequest extends FormRequest
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
        'name_ar'=>'required_if:name_en,null',
        'name_tr'=>'required_if:name_en,null',
        'name_en'=>'required_if:name_ar,null',
        'name_ku'=>'required_if:name_en,null',
        'first_title_ar'=>'required_if:name_en,null',
        'first_title_tr'=>'required_if:name_en,null',
        'first_title_en'=>'required_if:name_en,null',
        'first_title_ku'=>'required_if:name_en,null',
        'second_title_ar'=>'required_if:name_en,null',
        'second_title_tr'=>'required_if:name_en,null',
        'second_title_en'=>'required_if:name_en,null',
        'second_title_ku'=>'required_if:name_en,null',
        'third_title_ar'=>'required_if:name_en,null',
        'third_title_en'=>'required_if:name_en,null',
        'third_title_ku'=>'required_if:name_en,null',
        'third_title_tr'=>'required_if:name_en,null',
        'start_date'=>'date|required_if:name_en,null',
        'end_date'=>'date|required_if:name_en,null',
        'image'=>'required_if:name_en,null',
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
            'first_title_ar.required_if'=>trans('validation.required_if'),
            'first_title_en.required_if'=>trans('validation.required_if'),
            'first_title_ku.required_if'=>trans('validation.required_if'),
            'first_title_tr.required_if'=>trans('validation.required_if'),
            'second_title_ar.required_if'=>trans('validation.required_if'),
            'second_title_en.required_if'=>trans('validation.required_if'),
            'second_title_ku.required_if'=>trans('validation.required_if'),
            'second_title_tr.required_if'=>trans('validation.required_if'),
            'third_title_ar.required_if'=>trans('validation.required_if'),
            'third_title_en.required_if'=>trans('validation.required_if'),
            'third_title_ku.required_if'=>trans('validation.required_if'),
            'third_title_tr.required_if'=>trans('validation.required_if'),
            'start_date.required_if'=>trans('validation.required_if'),
            'end_date.required_if'=>trans('validation.required_if'),
            'start_date.date'=>trans('validation.date'),
            'end_date.date'=>trans('validation.date'),
            'image.required_if'=>trans('validation.required_if'),

        ];
    }
}
