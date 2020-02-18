<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:29
 */

namespace Core\Statistics;

use Core\Jobs\AbstractJob;

class JobStatistics
{
    /**
     * @var AbstractJob
     */
    private $job;

    public static function create(AbstractJob $job) : JobStatistics
    {
        return new static($job);
    }

    private function __construct(AbstractJob $job)
    {
        $this->job = $job;
    }

    public function getJob() : AbstractJob
    {
        return $this->job;
    }

    public function getResult()
    {
        return $this->run();
    }

    protected function run()
    {
        return 'default statistic';
    }
}