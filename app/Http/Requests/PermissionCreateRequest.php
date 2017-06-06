<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use App\Http\Requests\BaseFormRequest;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;
class PermissionCreateRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:permissions,slug',
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute 不能为空。',
            'unique'  => ':attribute 已经存在。',
        ];
    }

    public function attributes()
    {
        return [
            'name'  => '名称',
            'slug'  => '权限',
        ];
    }
    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
         $errors =  parent::formatErrors($validator);
        return ['status'=>'validate_fail', 'errors'=>$errors[':attribute'],'code'=>422];
    }
}
