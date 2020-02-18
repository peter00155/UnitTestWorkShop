<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 21:55
 */

namespace Core\Jobs;

use Core\Jobs\Mailing\MailingJob;
use Core\Jobs\Null\NullJob;
use Core\Jobs\Visit\VisitJob;

class JobsCollection
{
    private $jobs = [];

    public static function setup(): JobsCollection
    {
        $static = new static();
        $static->add(VisitJob::TYPE, VisitJob::create());
        $static->add(MailingJob::TYPE, MailingJob::create());

        return $static;
    }

    public static function create(): JobsCollection
    {
        return new static();
    }

    public function getJobs() : array
    {
        return $this->jobs;
    }

    public function add(string $type, AbstractJob $job) : JobsCollection
    {
        $this->jobs[$type] = $job;
        return $this;
    }

    public function get(JobEntityMock $jobEntityMock) : AbstractJob
    {
        if(isset($this->jobs[$jobEntityMock->getType()])) {
            $job = $this->jobs[$jobEntityMock->getType()];
        } else {
            $job = NullJob::create();
        }

        /** @var $job AbstractJob */
        return $job->setData($jobEntityMock);
    }
}