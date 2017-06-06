<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\RoleService;

class RoleController extends Controller
{

    protected $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }
    /**
     *  [index 角色列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T15:03:09+0800
     *  @return   [type]                   [description]
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->service->index();
        }
        return view('admin.role.index');
    }
    /**
     *  [create 角色添加视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T16:04:54+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        return $this->service->permission();
    }

    /**
     *  [store 角色添加操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T16:05:26+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     *  [show 角色详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T18:48:39+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     *  [edit 角色更新视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T19:31:40+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        return $this->service->findPermission($id);
    }
    /**
     *  [update description]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T19:12:12+0800
     *  @param    Request                  $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request,$id);
    }


    /**
     *  [destroy 角色删除]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T16:57:55+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    /**
     *  [permission 角色权限添加]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-15T12:40:38+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function permission(Request $request)
    {
        return $this->service->rolePermission($request);
    }
}
