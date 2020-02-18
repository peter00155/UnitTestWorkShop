<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 15.10.19
 * Time: 07:36
 */

namespace Tests\Statistics;

use Core\Jobs\AbstractJob;
use Core\Jobs\JobEntityMock;
use Core\Jobs\JobsCollection;
use Core\Jobs\Mailing\MailingJob;
use Core\Jobs\Null\NullJob;
use Core\Jobs\Visit\VisitJob;
use Core\Statistics\JobStatistics;
use Core\Statistics\Mailing\BossMailingStatistics;
use Core\Statistics\Mailing\CustomerMailingStatistics;
use Core\Statistics\Mailing\EmployeeMailingStatistics;
use Core\Statistics\Mailing\NullMailingStatistics;
use Core\Statistics\Null\NullStatistics;
use Core\Users\UserType;
use PHPUnit\Framework\TestCase;

class JobStatisticsTest extends TestCase
{
    public function testShouldCreateJobStatistics() : void
    {
        $mockEntity = JobEntityMock::create(VisitJob::TYPE);
        $job = VisitJob::create();
        $job->setData($mockEntity);

        $this->assertInstanceOf(
            JobStatistics::class,
            $job->getStatistics()
        );
    }

    public function testShouldCreateJobStatisticsWithResult() : void
    {
        $mockEntity = JobEntityMock::create(VisitJob::TYPE);
        $job = VisitJob::create();
        $job->setData($mockEntity);

        $this->assertNotEmpty(
            $job->getStatistics()->getResult()
        );
    }

    public function testShouldReturnJobFromJobStatistics() : void
    {
        $mockEntity = JobEntityMock::create(VisitJob::TYPE);
        $job = VisitJob::create();
        $job->setData($mockEntity);

        $this->assertInstanceOf(
            AbstractJob::class,
            $job->getStatistics()->getJob()
        );
    }

    public function testShouldReturnNullStatistics() :void
    {
        $mockEntity = JobEntityMock::create( 'asd');
        $job = NullJob::create();
        $job->setData($mockEntity);

        $this->assertInstanceOf(
            NullStatistics::class,
            $job->getStatistics()
        );
    }

    public function testShouldReturnNullStatisticsMsg() :void
    {
        $mockEntity = JobEntityMock::create( 'asd');
        $job = NullJob::create();
        $job->setData($mockEntity);

        $this->assertNotEmpty(
            $job->getStatistics()->getResult()
        );
    }

    public function testShouldReturnNullStatisticsFromCollection() :void
    {
        $mockEntity = JobEntityMock::create( 'asd');

        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(VisitJob::TYPE, VisitJob::create());

        $job = $collection->get($mockEntity);

        $this->assertInstanceOf(
            NullStatistics::class,
            $job->getStatistics()
        );
    }

    public function testShouldReturnNullStatisticsFromMailingNotCorrectUser() :void
    {
        $mockEntity = JobEntityMock::create( MailingJob::TYPE,UserType::NULL);

        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(VisitJob::TYPE, VisitJob::create());

        $job = $collection->get($mockEntity);

        $this->assertInstanceOf(
            NullMailingStatistics::class,
            $job->getStatistics()
        );
    }

    public function testShouldReturnBossMailingStatistics() :void
    {
        $mockEntity = JobEntityMock::create( MailingJob::TYPE,UserType::BOSS);

        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(VisitJob::TYPE, VisitJob::create());

        $job = $collection->get($mockEntity);

        $this->assertInstanceOf(
            BossMailingStatistics::class,
            $job->getStatistics()
        );
    }

    public function testShouldReturnBossMailingStatisticsMsg() :void
    {
        $mockEntity = JobEntityMock::create( MailingJob::TYPE,UserType::BOSS);
        $job = MailingJob::create();
        $job->setData($mockEntity);
        $statistics = BossMailingStatistics::create($job);

        $this->assertNotEmpty(
            $statistics->getResult()
        );
    }

    public function testShouldReturnEmployeeMailingStatisticsMsg() :void
    {
        $job = MailingJob::create();
        $statistics = EmployeeMailingStatistics::create($job);

        $this->assertNotEmpty(
            $statistics->getResult()
        );
    }

    public function testShouldReturnEmployeeMailingStatistics() :void
    {
        $mockEntity = JobEntityMock::create( MailingJob::TYPE,UserType::EMPLOYEE);

        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(VisitJob::TYPE, VisitJob::create());

        $job = $collection->get($mockEntity);

        $this->assertInstanceOf(
            EmployeeMailingStatistics::class,
            $job->getStatistics()
        );
    }

    public function testShouldReturnCustomerMailingStatistics() :void
    {
        $mockEntity = JobEntityMock::create( MailingJob::TYPE,UserType::CUSTOMER);

        $collection = JobsCollection::create();
        $collection->add(MailingJob::TYPE, MailingJob::create())
            ->add(VisitJob::TYPE, VisitJob::create());

        $job = $collection->get($mockEntity);

        $this->assertInstanceOf(
            CustomerMailingStatistics::class,
            $job->getStatistics()
        );
    }
}