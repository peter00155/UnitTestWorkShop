<?php

namespace Core\Statistics\Null;

use Core\Statistics\JobStatistics;

/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 15.10.19
 * Time: 07:47
 */



class NullStatistics extends JobStatistics
{
    protected function run()
    {
        return 'Null statistics';
    }
}