<?php
/**
 *  角色服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\RoleRepositoryEloquent;
use Aizxin\Repositories\Eloquent\PermissionRepositoryEloquent;
use Aizxin\Validators\RoleValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Exception;
use DB;
use Cache;
use Aizxin\Tools\Result;
class RoleService
{
	protected $roleRepo;
	protected $permissionRepo;
	protected $rValidator;
	public function __construct(
		RoleRepositoryEloquent $roleRepo,
		PermissionRepositoryEloquent $permissionRepo,
		RoleValidator $rValidator)
	{
		$this->roleRepo = $roleRepo;
		$this->permissionRepo = $permissionRepo;
		$this->rValidator = $rValidator;
	}
	/**
	 *  [index 角色列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T16:13:05+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$result = new Result();
		try {
			$queryParams = request()->except(['s']);
			ksort($queryParams);
			$queryString = http_build_query($queryParams);
			$url = request()->url();
			$fullUrl = "{$url}?{$queryString}";

			$rememberKey = sha1($fullUrl);
			// 每页显示条数
			$pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
			// $role = Cache::remember($rememberKey, 2, function () use ($pageSize) {
 			$role = $this->roleRepo->orderBy('id','asc')->paginate($pageSize,['id','name','slug'])->toArray();
   //      	});
			$result->data = $role;
		} catch (Exception $e) {
			$result->code = 1001;
			$result->status = 500;
			$result->message = trans('admin/alert.role.index_error');
		}
		return $result->toJson();
	}
	/**
	 * 添加角色
	 * @author 晚黎
	 * @date   2017-03-22T09:55:12+0800
	 * @param  [type]                   $attributes [description]
	 * @return [type]                               [description]
	 */
	public function store($request)
	{
		$result = new Result();
		$data = $request->all();
		try {
			$this->rValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
	        try {
		       $permission = $this->roleRepo->create($data);
		       $result->message = trans('admin/alert.role.create_success');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.role.create_error');
				$result->status = 'error';
			}
        } catch (ValidatorException $e) {
        	$result->code = 422;
			$result->message = $e->getMessageBag()->first();
			$result->status = 'error';
        }
		return $result->toJson();
	}
	/**
	 *  [update 角色修改]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T19:36:06+0800
	 *  @param    [type]                   $request [description]
	 *  @param    [type]                   $id      [description]
	 *  @return   [type]                            [description]
	 */
	public function update($request,$id)
	{
		$result = new Result();
		$data = $request->except(['id']);
		try {
			$this->rValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_UPDATE);
	        try {
				$isUpdate = $this->roleRepo->update($data,$id);
				if ($isUpdate) {
					$result->message = trans('admin/alert.role.edit_success');
				}
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.role.edit_error');
				$result->status = 'error';
			}
	        } catch (ValidatorException $e) {
        	$result->code = 422;
			$result->message = $e->getMessageBag()->first();
			$result->status = 'error';
        }
		return $result->toJson();
	}
	/**
	 * 删除数据
	 * @author 晚黎
	 * @date   2017-03-22T17:36:05+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function destroy($id)
	{
		$result = new Result();
		try {
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->roleRepo->multipleDestroy(explode(',', $id));
			}else{
				$isDestroy = $this->roleRepo->delete($id);
			}
			if ($isDestroy) {
				$result->message = trans('admin/alert.role.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.role.destroy_error');
			$result->status = 'error';
		}
		return $result->toJson();
	}

	/**
	 *  [show 查看角色信息]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T18:51:07+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function show($id)
	{
		return $this->roleRepo->find($id,['id','name','slug','description']);
	}
	/**
	 *  [permission 权限节点]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-14T18:26:10+0800
	 *  @return   [type]                   [description]
	 */
	public function permission()
	{
		if(Cache::has('permission')){
			return  Cache::get('permission');
		}
		$permission = $this->permissionRepo->all(['id','name','slug','parent_id'])->toArray();
		$data = sort_parent($permission);
		Cache::forever('permission',$data);
		return $data;
	}
	/**
	 *  [rolePermission 角色权限添加]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-15T12:42:30+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function rolePermission($request)
	{
		$result = new Result();
		$role = $this->roleRepo->find($request->id);
		$permission = $request->except(['id','s','_url']);
		$list = [];
		foreach ($permission as $key => $value) {
			$list[] = $value;
		}
		try {
			$role->syncPermissions($list);
			$result->message = trans('admin/alert.role.permission_success');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.role.permission_error');
			$result->status = 'error';
		}
		return $result->toJson();
	}
	/**
	 *  [findPermission 角色的权限]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-15T14:21:39+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function findPermission($id)
	{
		$role = $this->roleRepo->with('permissions')->find($id,['id','name','slug','description'])->toArray();
		$permission = [];
		if ($role['permissions']) {
			foreach ($role['permissions'] as $k => $v) {
				$permission[] = $v['id'];
			}
		}
		return $permission;
	}
}