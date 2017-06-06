<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Aizxin\Services\Admin\UserService;

class MenuComposer
{
    /**
     * 用户仓库实现.
     *
     * @var UserRepository
     */
    protected $service;

    /**
     * 创建一个新的属性composer.
     *
     * @param UserRepository $service
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('slidebar', $this->service->getPermissions());
    }
}