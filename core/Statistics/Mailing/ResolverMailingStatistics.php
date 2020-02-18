<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:36
 */

namespace Core\Statistics\Mailing;

use Core\Jobs\AbstractJob;
use Core\Statistics\JobStatistics;
use Core\Statistics\ResolverConditionInterface;

/** ChainOfResponsibility pattern */
class ResolverMailingStatistics
{
    public static function getStatistics(AbstractJob $job) : JobStatistics
    {
        $statistic = self::resolve($job);
        return $statistic::create($job);
    }

    private static function resolve(AbstractJob $job) : JobStatistics
    {
        /**
         * @var ResolverConditionInterface $bossStatistics
         * @var ResolverConditionInterface $employeeStatistics
         * @var ResolverConditionInterface $customerStatistics
         * @var ResolverConditionInterface $nullStatistics
         */
        $bossStatistics = BossMailingStatistics::create($job);
        $employeeStatistics = EmployeeMailingStatistics::create($job);
        $customerStatistics = CustomerMailingStatistics::create($job);
        $nullStatistics = NullMailingStatistics::create($job);

        $bossStatistics->successor($employeeStatistics);
        $employeeStatistics->successor($customerStatistics);
        $customerStatistics->successor($nullStatistics);

        return $bossStatistics->handle();
    }
}