<?php
namespace Aizxin\Tools;
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
use zgldh\QiniuStorage\QiniuStorage;
use Qiniu\Storage\BucketManager;
/**
 * @description: 七牛上传类
 */
class QiniuUpload {

    /**
     *  [uploadImage 上传图片到七牛]
     *  izxin.com
     *  @author qingfeng
     *  @DateTime 2016-09-23T17:52:15+0800
     *  @param    [type]                   $file [description]
     *  @return   [type]                         [description]
     */
    public function uploadImage($path,$file)
    {
        $disk = QiniuStorage::disk('qiniu');
        $fileName = md5($file->getClientOriginalName().time().rand()).'.'.$file->getClientOriginalExtension();
        $bool = $disk->put($path.$fileName,file_get_contents($file->getRealPath()));
        if ($bool) {
            $path = $disk->downloadUrl($path.$fileName);
            return $path;
        }
        return '';
    }
    /**
     *  [qiniuBase64 七牛base64上传]
     *  izxin.com
     *  @author qingfeng
     *  @DateTime 2016-09-26T15:16:34+0800
     *  @param    [type]                   $base64 [description]
     *  @return   [type]                           [description]
     */
    public function qiniuBase64($base64,$path)
    {
        // 构建鉴权对象
        $auth = new Auth(env('QINIU_AXXESS_KEY'), env('QINIU_SECRET_KEY'));
        // 生成上传 Token
        $token = $auth->uploadToken(env('QINIU_BUCKET'));
        // // 上传到七牛后保存的文件名
        $fileName = $path.md5(time()).'.png';
        // // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 上传文件到七牛
        list($ret, $err) = $uploadMgr->putFile($token, $fileName, $base64['base64']);
        if ($err !== null) {
            return false;
        } else {
            return "http://".env('QINIU_DOMAINS_DEFAULT')."/".$ret['key'];
        }
    }
    /**
     *  [qiniuDelete 七牛删除图片]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-01-17T13:36:17+0800
     *  @param    [type]                   $fileName [description]
     *  @return   [type]                             [description]
     */
    public function qiniuDelete($fileName)
    {
        //初始化Auth状态：
        $auth = new Auth(env('QINIU_AXXESS_KEY'), env('QINIU_SECRET_KEY'));

        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);

        //你要测试的空间， 并且这个key在你空间中存在
        $bucket = env('QINIU_BUCKET');
        // $key = 'php-logo.png';

        //删除$bucket 中的文件 $key
        $err = $bucketMgr->delete($bucket, $fileName);
        if ($err !== null) {
            return false;
        } else {
            return true;
        }
    }
}
