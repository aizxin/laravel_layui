<?php
/**
 *  七牛控制器
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Tools\QiniuUpload;
use Aizxin\Tools\Result;
class QiniuController extends Controller
{

	/**
     *  [index 七牛返回token]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-24T11:42:29+0800
     *  @return   [type]                   [description]
     */
    public function index()
    {
        return response()->json([
            'uptoken' => (new QiniuUpload())->qiniuToken()
        ]);
    }
    /**
     *  [create 七牛]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:50:00+0800
     *  @return   [type]                   [description]
     */
    public function create()
    {

    }
    /**
     *  [store 七牛上传图片]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:51:43+0800
     *  @return   [type]                   [description]
     */
    public function store(Request $request)
    {
        $files = $request->file('thumb');
        $path = '';
        $optput['code'] = -1;
        if (is_array($files)) {
            foreach($files as $key => $file){
                $info = (new QiniuUpload())->uploadImage($path,$file);
                if ($info) {
                    $optput[$key]['url']  = $info;
                    $optput['code'] = null;
                }
            }
            $optput['data'] = count($files);
        }else{
            $info = (new QiniuUpload())->uploadImage($path,$files);
            if ($info) {
                $optput['url']  = $info;
                $optput['code'] = 0;
            }
        }
        return response()->json($optput);
    }
    /**
     *  [edit 七牛]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:52:42+0800
     *  @return   [type]                   [description]
     */
    public function edit()
    {
    }
    /**
     *  [update 七牛删除图片]
     *  臭虫科技
     *  @author zzh
     *  @DateTime 2017-04-18T15:56:43+0800
     *  @return   [type]                   [description]
     */
    public function update(Request $request, $id)
    {
       $result = Result::init();
        $url = $request->urlPath;
        $path = explode(env('QINIU_DOMAINS_DEFAULT').'/', $url);
        if(count($path) == 0){
            $result->message = trans('admin/alert.setting.upload_destroy_error');
            $result->code = 400;
            return $result->toJson();
        }
        $res = (new QiniuUpload())->qiniuDelete($path[1]);
        if($res){
            $result->message = trans('admin/alert.setting.upload_destroy_success');
        }else {
            $result->message = trans('admin/alert.setting.upload_destroy_error');
            $result->code = 400;
        }
        return $result->toJson();
    }
    /**
     *  [destroy 七牛]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-18T15:57:34+0800
     *  @return   [type]                   [description]
     */
    public function destroy($id)
    {

    }

}
