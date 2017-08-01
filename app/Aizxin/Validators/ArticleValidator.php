<?php
namespace Aizxin\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ArticleValidator extends LaravelValidator {

   /**
    *  [$rules 规则]
    *  @var [type]
    */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => ['required'],
            'articleCategoryId' => ['required'],
            'content' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => ['required'],
            'articleCategoryId' => ['required'],
            'content' => ['required'],
        ],
    ];
    /**
     *  [$messages 错误信息]
     *  @var [type]
     */
    protected $messages = [
        'name.required' => '文章标题不能为空',
        'articleCategoryId.required' => '文章分类不能为空',
        'content.required' => '文章内容不能为空',
	];
}