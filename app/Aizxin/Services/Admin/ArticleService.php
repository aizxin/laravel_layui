<?php
/**
 *  文章服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\ArticleRepositoryEloquent;
use Aizxin\Repositories\Eloquent\ArticleCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\ArticleValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class ArticleService
{
	protected $aRepo;
	protected $cRepo;
	protected $validator;
	
	public function __construct(
		ArticleRepositoryEloquent $repo,
		ArticleValidator $validator,
		ArticleCategoryRepositoryEloquent $cRepo)
	{
		$this->aRepo = $repo;
		$this->cRepo = $cRepo;
		$this->validator = $validator;
		
	}
	/**
	 *  [articleCategory 文章分类]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-19T17:08:22+0800
	 *  @return   [type]                   [description]
	 */
	public function articleCategory()
	{
		if(Cache::has(config('admin.global.cache.articlecategory_add'))){
			return Cache::get(config('admin.global.cache.articlecategory_add'));
		}
		$list = $this->cRepo->findWhere(['status'=>1],['id','name','parent_id'])->toArray();
		$data = sort_parent($list);
		Cache::forever(config('admin.global.cache.articlecategory_add'),$data);
		return $data;
	}
	/**
	 *  [store 文章添加]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-21T11:21:27+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function store($request)
	{
		$result = new Result();
		$id = $request->id;
		$data = $request->except(['id']);
		try {
			$this->validator->with( $data )->passesOrFail($id>0?ValidatorInterface::RULE_CREATE:ValidatorInterface::RULE_UPDATE);
	        try {
	        	$data['author'] = auth()->user()->name;
	        	if($id){
	        		$this->aRepo->update($data,$id);
	        	}else{
	        		$this->aRepo->create($data);
	        	}
		       $result->message = $id?trans('admin/alert.article.edit_success'):trans('admin/alert.article.create_success');
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = $id?trans('admin/alert.article.edit_error'):trans('admin/alert.article.create_error');
			}
        } catch (ValidatorException $e) {
        	$result->code = 422;
			$result->message = $e->getMessageBag()->first();
        }
		return $result->toJson();
	}
	/**
	 *  [index 文章列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-21T11:44:05+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$result = new Result();
		try {
			// 每页显示条数
			$pageSize = request('pageSize', config('admin.global.pagination.pageSize'));
			$result->data = $this->aRepo->index($pageSize);
		} catch (Exception $e) {
			$result->code = 1001;
			$result->message = trans('admin/alert.article.index_error');
		}
		return $result->toJson();
	}
	/**
	 *  [destroy 文章删除]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-21T14:13:19+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id)
	{
		$result = new Result();
		try {
			// 批量删除
			if (!is_numeric($id)) {
				$isDestroy = $this->aRepo->multipleDestroy(explode(',', $id));
			} else {
				$isDestroy = $this->aRepo->delete($id);
			}
			if ($isDestroy) {
				$result->message = trans('admin/alert.article.destroy_success');
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.article.destroy_error');
		}
		return $result->toJson();
	}
	/**
	 *  [edit 文章]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-21T14:49:26+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function edit($id)
	{
		return $this->aRepo->skipPresenter()->find($id);
	}
	/**
     *  [changeSwitch 文章排序]
     *  臭虫科技
     *  @author qingfeng
     *  @DateTime 2017-04-26T19:00:17+0800
     *  @param    string                   $value [description]
     *  @return   [type]                          [description]
     */
    public function changeSwitch($request)
    {
    	$result = new Result();
        $id = $request->input('id');
        $data = $request->except('id');
        try {
            $this->aRepo->update($data,$id);
            $result->message = trans('admin/alert.rank.index_success');
        } catch (Exception $e) {
            $result->code = 400;
            $result->message = trans('admin/alert.rank.index_error');;
        }
        return $result->toJson();
    }
}