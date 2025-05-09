<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRquest extends FormRequest
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
            'name' => 'required|between:2,10',
            'sex' => 'required|sex',
            'age' => 'required|integer|between:1,100',
            'birthday' => 'required|date',
            'm_id' => 'required|integer',
            'logo' => 'file|image|max:200'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名字不能为空',
            'sex.required' => '性别不能为空',
            'sex.sex' => '性别只能为男或者女',
            'age.required' => '年龄不能为空',
            'age.between' => '年龄必须在15到100之间',
            'birthday.required' => '生日不能为空',
            'm_id.required' => '专业不能为空',
        ];
    }
}
