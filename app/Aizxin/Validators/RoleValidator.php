<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class RoleValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required','unique:roles'],
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
        'name.required' => '角色名称不能为空',
        'name.unique' => '角色名称已存在',
        'slug.required' => '角色不能为空',
	];
}