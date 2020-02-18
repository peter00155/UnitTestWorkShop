<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 23:40
 */

namespace Core\Statistics\Mailing;

use Core\Statistics\ConditionJobStatistics;
use Core\Statistics\JobStatistics;
use Core\Statistics\Null\NullStatistics;
use Core\Statistics\ResolverConditionInterface;

class NullMailingStatistics extends ConditionJobStatistics implements ResolverConditionInterface
{
    public function handle() : JobStatistics
    {
        return $this;
    }

}