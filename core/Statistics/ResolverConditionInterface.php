<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:47
 */

namespace Core\Statistics;

interface ResolverConditionInterface
{
    public function handle() : JobStatistics;

    public function successor(ResolverConditionInterface $jobStatistics);
}