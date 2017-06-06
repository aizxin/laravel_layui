<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\MessageBag;
class BaseFormRequest extends FormRequest
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
    protected function formatErrors(Validator $validator)
    {
        $errors =  parent::formatErrors($validator);
        return ['status'=>'validate_fail', 'errors'=>$errors,'code'=>422];
    }
}