<?php

namespace Aizxin\Models;
use Illuminate\Database\Eloquent\Model;
use Aizxin\Models\ArticleCategory;
/**
 *  文章模型
 */
class Article extends Model
{
    // 指定文章分类表
    protected $table = 'article';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'articleCategoryId', 'title', 'content','author','thumb','rank'
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    /**
     *  [user 管理员关联]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-19T12:13:49+0800
     *  @param    string                   $value [description]
     */
    public function user()
    {
        # code...
    }
    /**
     *  [category 分类管理]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-21T11:52:25+0800
     *  @return   [type]                   [description]
     */
    public function category()
    {
        return $this->belongsTo('Aizxin\Models\ArticleCategory','articleCategoryId','id');
    }
}
