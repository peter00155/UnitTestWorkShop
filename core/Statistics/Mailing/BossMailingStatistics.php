<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:36
 */

namespace Core\Statistics\Mailing;

use Core\Statistics\ConditionJobStatistics;
use Core\Statistics\JobStatistics;
use Core\Statistics\ResolverConditionInterface;
use Core\Users\UserType;

class BossMailingStatistics extends ConditionJobStatistics implements ResolverConditionInterface
{
    public function handle() : JobStatistics
    {
        if($this->getJob()->getData()->getUser() === UserType::BOSS) {
            return $this;
        }

        return $this->successor->handle();
    }

    protected function run()
    {
        return 'Boss statistics';
    }
}