<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\UserRepository;
use Aizxin\Models\User;


/**
 *  管理员接口实现
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
