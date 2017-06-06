<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\PermissionService;

class PermissionController extends Controller
{
    protected $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }


    /**
     *  [index 权限节点列表]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-13T15:03:20+0800
     *  @param    Request                  $request [description]
     *  @return   [type]                            [description]
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->service->index();
        }
        return view('admin.permission.index');
    }
    /**
     *  [create 权限添加视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-11T19:33:57+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        $permission = $this->service->permissionParentList();
        return view('admin.permission.create',compact('permission'));
    }
    /**
     *  [store 权限添加操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-11T19:34:29+0800
     *  @param    PermissionCreateRequest  $request [description]
     *  @return   [type]                            [description]
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    /**
     *  [edit 权限编辑视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-12T19:28:55+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $permission = $this->service->permissionParentList();
        $per = $this->service->edit($id);
        return view('admin.permission.edit',compact('permission','per'));
    }


    /**
     *  [update 权限更新操作]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-12T21:16:09+0800
     *  @param    Request                  $request [description]
     *  @param    [type]                   $id      [description]
     *  @return   [type]                            [description]
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request,$id);
    }


    /**
     *  [destroy 删除权限节点]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-12T18:50:29+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    /**
     * 获取当前用户的所有权限
     * @author 晚黎
     * @date   2017-03-14T09:29:03+0800
     * @return [type]                   [description]
     */
    public function getUserPermissions()
    {
        $responseData = $this->service->userPermissions();
        return response()->json($responseData,$responseData['status']);
    }
}
