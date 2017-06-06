<?php
/**
 *  管理员
 */
namespace App\Http\Controllers\Admin;

use Aizxin\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {
	protected $service;

	public function __construct(UserService $service) {
		$this->service = $service;
	}
	/**
	 *  [index 管理员列表]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-08T02:16:45+0800
	 *  @return   [type]                   [description]
	 */
	public function index(Request $request) {
		if ($request->ajax()) {
			return $this->service->index($request);
		}
		return view('admin.user.index');
	}
	/**
	 *  [store 管理员添加操作]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T14:59:36+0800
	 *  @param    Request                  $request [description]
	 *  @return   [type]                            [description]
	 */
	public function store(Request $request) {
		return $this->service->addUser($request);
	}
	/**
	 *  [destroy 管理员删除]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T15:11:54+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id) {
		return $this->service->destroy($id);
	}
	/**
	 *  [show 管理员详情]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T15:24:08+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function show($id) {
		return $this->service->show($id);
	}
	/**
	 *  [update 管理员更新]
	 *  chouchong.com
	 *  @author Sow
	 *  @DateTime 2017-04-16T15:38:25+0800
	 *  @param    Request                  $request [description]
	 *  @param    [type]                   $id      [description]
	 *  @return   [type]                            [description]
	 */
	public function update(Request $request, $id) {
		return $this->service->update($request, $id);
	}
    /**
     *  [create 获取管理员的角色列表]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T21:04:44+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        return $this->service->role();
    }
    /**
     *  [edit 获取管理员的角色]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T21:15:59+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->service->getRole($id);
    }
    /**
     *  [role 管理员的角色分配]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-16T23:20:29+0800
     *  @return   [type]                   [description]
     */
    public function role(Request $request)
    {
        return $this->service->syncRoles($request);
    }
}
