<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 21:50
 */

require __DIR__.'/vendor/autoload.php';

use Core\Jobs\JobEntityMock;
use Core\Jobs\JobsCollection;
use Core\Jobs\Mailing\MailingJob;

$entityJob = JobEntityMock::create(MailingJob::TYPE, 'asd');

$collection = JobsCollection::create();
$job = $collection->get($entityJob);

echo $job->getStatistics()->getResult();

