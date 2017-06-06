<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator {

	/**
	 *  [$rules 管理员规则]
	 *  @var [type]
	 */
	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'username' => ['required', 'unique:users'],
			'name' => ['required'],
			'password' => ['required', 'between:6,16'],
		],
		ValidatorInterface::RULE_UPDATE => [
			'username' => ['required'],
			'name' => ['required'],
			'password' => ['required', 'between:6,12'],
		],
	];
	/**
	 *  [$messages 管理员错误信息]
	 *  @var [type]
	 */
	protected $messages = [
		'username.required' => '账号为必填项',
		'username.exists' => '账号不存在',
		'username.unique' => '账号已存在',
		'password.required' => '密码为必填项',
		'password.between' => '密码长度必须是6-12',
		'name.required' => '名称为必填项',
	];
}