<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 21.10.19
 * Time: 07:51
 */

namespace Core\Statistics;


abstract class ConditionJobStatistics extends JobStatistics
{
    /**
     * @var ResolverConditionInterface
     */
    protected $successor;

    public function successor(ResolverConditionInterface $jobStatistics)
    {
        $this->successor = $jobStatistics;
    }
}