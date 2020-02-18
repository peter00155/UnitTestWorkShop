<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 12.10.19
 * Time: 21:34
 */

namespace Tests\Jobs;

use Core\Jobs\AbstractJob;
use Core\Jobs\JobEntityMock;
use Core\Jobs\JobsCollection;
use Core\Jobs\Mailing\MailingJob;
use Core\Jobs\Null\NullJob;
use Core\Jobs\Visit\VisitJob;
use PHPUnit\Framework\TestCase;

class JobCollectionTest extends TestCase
{
    public function testShouldCreateJobCollection() : void
    {
        $this->assertInstanceOf(
            JobsCollection::class,
            JobsCollection::create()
        );
    }

    public function testShouldCreateEmptyJobCollection() : void
    {
        $this->assertEmpty(
            JobsCollection::create()->getJobs()
        );
    }

    public function testShouldCreateJobCollectionWithOneElement() : void
    {
        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create());

        $this->assertCount(
            1,
            $collection->getJobs()
        );
    }

    public function testShouldCreateJobCollectionWithOneElementWhenAddedTwoOrMoreSameJobs() : void
    {
        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(MailingJob::TYPE, MailingJob::create());

        $this->assertCount(
            1,
            $collection->getJobs()
        );
    }

    public function testShouldCreateJobCollectionWithManyElement() : void
    {
        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(VisitJob::TYPE, VisitJob::create());

        $this->assertCount(
            2,
            $collection->getJobs()
        );
    }

    public function testShouldCreateNotEmptyJobCollection() : void
    {
        $this->assertNotEmpty(
            JobsCollection::setup()->getJobs()
        );
    }

    public function testShouldGetJobFromJobCollection() : void
    {
        $mockEntity = JobEntityMock::create(MailingJob::TYPE);

        $this->assertInstanceOf(
            AbstractJob::class,
            JobsCollection::setup()->get($mockEntity)
        );
    }

    public function testShouldGetNullJobFromJobCollection() : void
    {
        $mockEntity = JobEntityMock::create('asd');

        $this->assertInstanceOf(
            NullJob::class,
            JobsCollection::setup()->get($mockEntity)
        );
    }
}