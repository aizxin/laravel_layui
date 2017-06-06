<?php

namespace Aizxin\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 *  按照多id删除规范
 */
class DestroyByIdsCriteria implements CriteriaInterface
{
    protected $ids;

    function __construct($ids)
    {
        $this->ids = $ids;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->destroy($this->ids);
    }
}
