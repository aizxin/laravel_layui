<?php

namespace Aizxin\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 *  分页规范
 */
class PaginationCriteria implements CriteriaInterface
{
    protected $limit;
    protected $offset;
    public function __construct($limit, $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
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
        return $model->offset($this->offset)->limit($this->limit);
    }
}
