<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:03
 */

namespace Core\Jobs;

use Core\Statistics\JobStatistics;

abstract class AbstractJob
{
    private $data;

    public static function create()
    {
        return new static();
    }

    public function setData(JobEntityMock $jobEntityMock)
    {
        $this->data = $jobEntityMock;
        return $this;
    }

    public function getStatistics()
    {
        return JobStatistics::create($this);
    }

    /**
     * @return JobEntityMock
     */
    public function getData() : ?JobEntityMock
    {
        return $this->data;
    }


}