<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\ArticleService;

class ArticleController extends Controller
{
    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }


    /**
     *  [index 文章列表]
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
        return view('admin.article.article.index');
    }
    /**
     *  [create 文章添加视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-11T19:33:57+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {
        $category = $this->service->articleCategory();
        return view('admin.article.article.create',compact('category'));
    }
    /**
     *  [store 文章添加操作]
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
     *  [edit 文章编辑视图]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-12T19:28:55+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function edit($id)
    {
        $category = $this->service->articleCategory();
        $article = $this->service->edit($id);
        return view('admin.article.article.edit',compact('category','article'));
    }


    /**
     *  [update 文章更新操作]
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
     *  [destroy 删除文章]
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
     *  [changeSwitch 文章排序]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T19:00:17+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function changeSwitch(Request $request)
    {
        return $this->service->changeSwitch($request);
    }
}
