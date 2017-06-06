<?php

namespace Aizxin\Models;
use Illuminate\Notifications\Notifiable;
use Ultraware\Roles\Traits\HasRoleAndPermission;
use Ultraware\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 *  管理员模型
 */
class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
