<?php
/**
 *  管理员服务
 */
namespace Aizxin\Services\Admin;

use Aizxin\Repositories\Eloquent\UserRepositoryEloquent;
use Aizxin\Repositories\Eloquent\RoleRepositoryEloquent;
use Aizxin\Tools\Result;
use Aizxin\Validators\UserLoginValidator;
use Aizxin\Validators\UserValidator;
use Auth;
use Cache;
use Exception;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService {
	protected $userRepo;
	protected $uValidator;
    protected $userValidator;
    protected $roleRepo;
    
	public function __construct(
		UserRepositoryEloquent $userRepo,
		UserLoginValidator $uValidator,
        UserValidator $userValidator,
        RoleRepositoryEloquent $roleRepo) {
        $this->roleRepo = $roleRepo;
		$this->userRepo = $userRepo;
		$this->uValidator = $uValidator;
        $this->userValidator = $userValidator;
        
	}
	/**
	 *  [postLogin 管理员登录]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-05T14:47:46+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function postLogin($request) {
		$result = new Result();
		$data = $request->only('username', 'password');
		try {
			$this->uValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			try {
				Auth::guard('web')->attempt($data);
				$result->user = Auth::user()->toArray();
				$result->message = trans('admin/alert.user.login_success');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.user.login_error');
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
	 *  [addUser 管理员添加]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-05T14:54:46+0800
	 *  @param    [type]                   $request [description]
	 */
	public function addUser($request) {
		$result = new Result();
		$data = $request->only(['username', 'password', 'name']);
		try {
			$this->userValidator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$data['password'] = bcrypt($data['password']);
			try {
				$this->userRepo->create($data);
				$result->message = trans('admin/alert.user.create_success');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = $e;
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
	 *  [index 管理员列表]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-15T23:26:15+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function index($request) {
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
				$user = $this->userRepo->orderBy('id', 'asc')->paginate($pageSize, ['id', 'name', 'username'])->toArray();
			// });
			$result->data = $user;
		} catch (Exception $e) {
			$result->code = 1001;
			$result->status = 500;
			$result->message = trans('admin/alert.user.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [destroy 管理员删除]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T15:12:40+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id) {
		$result = new Result();
		try {
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->userRepo->multipleDestroy(explode(',', $id));
			} else {
				$isDestroy = $this->userRepo->delete($id);
			}
			if ($isDestroy) {
				$result->message = trans('admin/alert.user.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.user.destroy_error');
			$result->status = 'error';
		}
		return $result->toJson();
	}
	/**
	 *  [show 管理员详情]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T15:25:42+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function show($id) {
		return $this->userRepo->find($id, ['id', 'name', 'username', 'password']);
	}
	/**
	 *  [update 管理员修改]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-13T19:36:06+0800
	 *  @param    [type]                   $request [description]
	 *  @param    [type]                   $id      [description]
	 *  @return   [type]                            [description]
	 */
	public function update($request, $id) {
		$result = new Result();
		$data = $request->except(['id']);
		try {
			$this->userValidator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			try {
                $data['password'] = bcrypt($data['password']);
				$isUpdate = $this->userRepo->update($data, $id);
				if ($isUpdate) {
					$result->message = trans('admin/alert.user.edit_success');
				}
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = trans('admin/alert.user.edit_error');
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
     *  [role 获取角色列表]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T21:06:52+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function role()
    {
        if(Cache::has('role')){
            return Cache::get('role');
        }
        $role = $this->roleRepo->all(['id','name'])->toArray();
        Cache::forever('role',$role);
        return $role;
    }
    /**
     *  [getRole 管理员的角色]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T21:17:17+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function getRole($id)
    {
        $data = $this->userRepo->find($id)->getRoles()->toArray();
        return count($data)?$data[0]:[];
    }
    /**
     *  [syncRoles 管理员的角色分配]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T23:22:04+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function syncRoles($request)
    {
    	$result = new Result();
		$id = $request->only(['id']);
		$role = $request->only(['role']);
		$roleIds = [];
		foreach ($role as $key => $v) {
			$roleIds[] = $v;
		}
		try {
            $this->userRepo->find($id['id'])->syncRoles($roleIds);
            $result->message = trans('admin/alert.user.role_succes');
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.user.role_error');
			$result->status = 'error';
		}
		return $result->toJson();
    }
    /**
     *  [getPermissions 管理员的权限节点]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T23:58:10+0800
     *  @return   [type]                   [description]
     */
    public function getPermissions()
    {
        $user = auth()->user();
        if(Cache::has('userpermission'.$user->id)){
           return Cache::get('userpermission'.$user->id);
        }
        $permission = $user->getPermissions()->toArray();
        $data = sort_parent($permission);
        Cache::forever('userpermission'.$user->id,$data);
        return $data;
    }
}