<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UserLoginValidator extends LaravelValidator {

    /**
    *  [$rules 用户登录规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'username' => ['required','unique:users'],
            'password' => ['required', 'between:6,16'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'username' => ['required',"exists:users"],
            'password' => ['required','between:6,12']
        ],
    ];
    /**
     *  [$messages 用户登录错误信息]
     *  @var [type]
     */
    protected $messages = [
        'username.required' => '账号为必填项',
        'username.exists' => '账号不存在',
        'username.unique' => '账号已存在',
        'password.required' => '密码为必填项',
        'password.between' => '密码长度必须是6-12',
    ];
}