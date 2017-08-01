<?php
/**
 *  权限服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\PermissionRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\PermissionValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class PermissionService
{
	protected $permissionRepo;
	protected $pValidator;
	
	public function __construct(
		PermissionRepositoryEloquent $permissionRepo,
		PermissionValidator $pValidator)
	{
		$this->permissionRepo = $permissionRepo;
		$this->pValidator = $pValidator;
		
	}
	/**
	 *  [index description]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T16:06:33+0800
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
			// $permissions = Cache::remember($rememberKey, 2, function () use ($pageSize) {
            $permissions = $this->permissionRepo->orderBy('id','asc')->paginate($pageSize,['id','name','slug'])->toArray();
   //      	});
			$result->data = $permissions;
		} catch (Exception $e) {
			$result->code = 1001;
			$result->status = 500;
			$result->message = trans('admin/alert.permission.index_error');
		}
		return $result->toJson();
	}

	/**
	 *  [store 添加权限]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-11T19:49:22+0800
	 *  @param    [type]                   $attributes [description]
	 *  @return   [type]                               [description]
	 */
	public function store($request)
	{
		$result = new Result();
		$data = $request->all();
		try {
			$this->pValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
	        try {
		       $permission = $this->permissionRepo->create($data);
		       $result->message = trans('admin/alert.permission.create_success');
		       Cache::forget('permission');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.permission.create_error');
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
	 *  [permissionParentList 权限的父子关系]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-11T20:40:20+0800
	 *  @param    string                   $value [description]
	 *  @return   [type]                          [description]
	 */
	public function permissionParentList()
	{
		if(Cache::has('permission')){
			return Cache::get('permission');
		}
		$permission = $this->permissionRepo->all(['id','name','slug','parent_id'])->toArray();
		$data = sort_parent($permission);
		Cache::forever('permission',$data);
		return $data;
	}
	/**
	 *  [edit 权限详情]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-12T19:30:48+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function edit($id)
	{
		return $this->permissionRepo->skipPresenter()->find($id);
	}

	/**
	 * 修改权限数据
	 * @author 晚黎
	 * @date   2017-03-16T10:36:52+0800
	 * @param  [type]                   $attributes [description]
	 * @param  [type]                   $id         [description]
	 * @return [type]                               [description]
	 */
	public function update($request,$id)
	{
		$result = new Result();
		$data = $request->except(['id']);
		try {
			$this->pValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_UPDATE);
	        try {
				$isUpdate = $this->permissionRepo->update($data,$id);
				if ($isUpdate) {
					$result->message = trans('admin/alert.permission.edit_success');
				}
				Cache::forget('permission');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.permission.edit_error');
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
	 *  [destroy 删除权限节点]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-12T18:53:32+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id)
	{
		$result = new Result();
		try {
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->permissionRepo->multipleDestroy(explode(',', $id));
			}else{
				$isDestroy = $this->permissionRepo->delete($id);
			}
			if ($isDestroy) {
				$result->message = trans('admin/alert.permission.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.permission.destroy_error');
			$result->status = 'error';
		}
		return $result->toJson();
	}
	/**
	 *  [getMenuId 当前的url的id和子父级id]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-17T11:13:45+0800
	 *  @param    [type]                   $name [description]
	 *  @return   [type]                         [description]
	 */
	public function getMenuId($name)
	{
		$arr = [];
		$zdata = $this->permissionRepo->findByField('slug',$name)->toArray();
		if(count($zdata)){
			$arr['zMenu'] = $zdata[0];
			if($arr['zMenu']['parent_id'] > 0){
				$fdata = $this->permissionRepo->findByField('id',$arr['zMenu']['parent_id'])->toArray();
				$arr['fMenu'] = $fdata[0];
			}
		}
		return count($arr)?$arr:false;
	}
}