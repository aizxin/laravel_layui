<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
/**
 *  文章分类模型
 */
class ArticleCategory extends Model
{
    // 指定文章分类表
    protected $table = 'article_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'status',
    ];
    /**
     *  [article 文章关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-19T11:27:51+0800
     *  @return   [type]                   [description]
     */
    public function article()
    {
        return $this->hasMany('Aizxin\Models\Article', 'articleCategoryId', 'id');
    }
}
