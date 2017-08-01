<?php
/**
 *  文章分类服务
 */
namespace Aizxin\Services\Admin;
use Aizxin\Repositories\Eloquent\ArticleCategoryRepositoryEloquent;
use Aizxin\Tools\Result;
use Exception;
use Aizxin\Validators\ArticleCategoryValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Cache;
class ArticleCategoryService
{
	protected $aCategoryRepo;
	protected $pValidator;
	
	public function __construct(
		ArticleCategoryRepositoryEloquent $aCategoryRepo,
		ArticleCategoryValidator $pValidator)
	{
		$this->aCategoryRepo = $aCategoryRepo;
		$this->pValidator = $pValidator;
		
	}
	/**
	 *  [store 文章分类添加]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-18T12:08:57+0800
	 *  @param    [type]                   $request [description]
	 *  @return   [type]                            [description]
	 */
	public function store($request)
	{
		$result = new Result();
		$id = $request->id;
		$data = $request->except(['id']);
		try {
			$this->pValidator->with( $data )->passesOrFail(ValidatorInterface::RULE_CREATE);
	        try {
	        	if($id){
	        		$this->aCategoryRepo->update($data,$id);
	        	}else{
	        		$this->aCategoryRepo->create($data);
	        	}
		       $result->message = $id?trans('admin/alert.category.edit_success'):trans('admin/alert.category.create_success');
		       Cache::forget(config('admin.global.cache.articlecategory'));
			} catch (Exception $e) {
				$result->code = 400;
				$result->message = $id?trans('admin/alert.category.edit_error'):trans('admin/alert.category.create_error');
			}
        } catch (ValidatorException $e) {
        	$result->code = 422;
			$result->message = $e->getMessageBag()->first();
        }
		return $result->toJson();
	}
	/**
	 *  [index 文章分类列表]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-18T12:25:17+0800
	 *  @return   [type]                   [description]
	 */
	public function index()
	{
		$result = new Result();
		if(Cache::has(config('admin.global.cache.articlecategory'))){
			$result->data = Cache::get(config('admin.global.cache.articlecategory'));
			return $result->toJson();
		}
		try {
			$list = $this->aCategoryRepo->all(['id','parent_id','name','status'])->toArray();
			$data = sort_parent($list);
			Cache::forever(config('admin.global.cache.articlecategory'),$data);
			$result->data = $data;
        } catch (Exception $e) {
        	$result->code = 422;
			$result->message = trans('admin/alert.category.index_error');
        }
		return $result->toJson();
	}
	/**
	 *  [destroy description]
	 *  臭虫科技
	 *  @author chouchong
	 *  @DateTime 2017-04-19T11:11:17+0800
	 *  @param    [type]                   $id [description]
	 *  @return   [type]                       [description]
	 */
	public function destroy($id)
	{
		$result = new Result();
		try {
			$aCategory = $this->aCategoryRepo->withCount('article')->find($id);
			if($aCategory->article_count){
				$result->message = trans('admin/alert.category.destroy_delete');
			}else{
				$isDestroy = $this->aCategoryRepo->delete($id);
				if ($isDestroy) {
					$result->message = trans('admin/alert.category.destroy_success');
					Cache::forget(config('admin.global.cache.articlecategory'));
				}
			}
		} catch (Exception $e) {
			$result->code = 400;
			$result->message = trans('admin/alert.category.destroy_error');
		}
		return $result->toJson();
	}
}