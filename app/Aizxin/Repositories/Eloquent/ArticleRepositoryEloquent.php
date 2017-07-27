<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\ArticleRepository;
use Aizxin\Models\Article;


/**
 *  文章接口实现
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }
    /**
     *  [multipleDestroy 批量删除]
     *  chouchong.com
     *  @author Sow
     *  @DateTime 2017-04-03T13:05:29+0800
     *  @param    [type]                   $ids [数组]
     *  @return   [type]                        [ture/false]
     */
    public function multipleDestroy($ids)
    {
        return $this->model->destroy($ids);
    }
    /**
     *  [index 文章]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T12:41:58+0800
     *  @param    [type]                   $data [description]
     *  @return   [type]                         [description]
     */
    public function index($data)
    {
        return $this->model
            ->orderBy("rank",'asc')
            ->with(['category'=>function($query){
                $query->select('id','name');
            }])
            ->paginate($data,['id','title','author','articleCategoryId','rank'])
            ->toArray();
    }
    /**
     *  [findById 文章详情]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T17:04:24+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function articleOne($id)
    {
        return $this->with(['category'=>function($query){
            $query->select('id','name');
        }])->find($id);
    }
}
