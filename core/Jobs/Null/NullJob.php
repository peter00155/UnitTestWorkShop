<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 23:37
 */

namespace Core\Jobs\Null;

use Core\Jobs\AbstractJob;
use Core\Statistics\Null\NullStatistics;

class NullJob extends AbstractJob
{
    public function getStatistics()
    {
        return NullStatistics::create($this);
    }
}