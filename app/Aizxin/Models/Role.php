<?php

namespace Aizxin\Models;
use Ultraware\Roles\Models\Role as Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
/**
 *  角色模型
 */
class Role extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = ['name', 'slug', 'description', 'level'];
}
