<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required','unique:permissions'],
            // 'parent_id' => ['required'],
            // 'ismenu' => ['required'],
            'slug' => ['required'],
            // 'description' => ['required'],
            // 'icon' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
            // 'parent_id' => ['required'],
            // 'ismenu' => ['required'],
            'slug' => ['required'],
            // 'description' => ['required'],
            // 'icon' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'name.required' => '权限不能为空',
        'name.unique' => '权限已存在',
        'slug.unique' => '权限别名不能为空',
	];
}