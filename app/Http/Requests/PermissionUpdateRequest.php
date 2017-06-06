<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;
class PermissionUpdateRequest extends BaseFormRequest
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
            'slug' => ['required',Rule::unique('permissions')->ignore($this->id)]
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
}
