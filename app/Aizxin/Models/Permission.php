<?php
namespace Aizxin\Models;
use Ultraware\Roles\Models\Permission as Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
/**
 *  权限模型
 */
class Permission extends Model implements Transformable
{
	use TransformableTrait;
	protected $fillable = ['name', 'slug', 'description', 'model','parent_id','ismenu','icon','issort'];

}
