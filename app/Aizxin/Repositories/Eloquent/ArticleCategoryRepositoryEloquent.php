<?php

namespace Aizxin\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Aizxin\Repositories\Contracts\ArticleCategoryRepository;
use Aizxin\Models\ArticleCategory;


/**
 *  文章分类接口实现
 */
class ArticleCategoryRepositoryEloquent extends BaseRepository implements ArticleCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ArticleCategory::class;
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
     *  [articleCategoryList 分类下的文章]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T16:55:28+0800
     *  @return   [type]                   [description]
     */
    public function articleCategoryList()
    {   
        return $this->with(['article'=>function($sql){
            $sql->orderBy('rank','asc')->get();
        }])->all(['id','name'])->toArray();
    }
    /**
     *  [articleCategoryById 某一个分类下的文章]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-05-08T17:01:03+0800
     *  @param    [type]                   $id [description]
     *  @return   [type]                       [description]
     */
    public function articleCategoryById($id)
    {
        return $this->with(['article'=>function($sql){
            $sql->orderBy('rank','asc')->get();
        }])->find($id,['id','name'])->toArray();
    }
}
