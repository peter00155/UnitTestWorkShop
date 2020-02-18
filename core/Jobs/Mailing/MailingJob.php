<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:02
 */

namespace Core\Jobs\Mailing;

use Core\Jobs\AbstractJob;
use Core\Statistics\Mailing\ResolverMailingStatistics;

class MailingJob extends AbstractJob
{
    const TYPE = 'mailing';

    public function getStatistics()
    {
        return ResolverMailingStatistics::getStatistics($this);
    }
}