<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AdValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'name.required' => '广告名不能为空',
	];
}