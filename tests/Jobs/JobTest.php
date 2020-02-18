<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 13.10.19
 * Time: 08:49
 */

namespace Tests\Jobs;


use Core\Jobs\AbstractJob;
use Core\Jobs\JobEntityMock;
use Core\Jobs\Null\NullJob;
use Core\Jobs\Visit\VisitJob;
use Core\Statistics\JobStatistics;
use Core\Users\UserType;
use Core\VO\Exception\NotAllowedTypeException;
use Core\VO\Exception\NotAllowedUserException;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    public function testShouldCreateJob() : void
    {
        $this->assertInstanceOf(
            AbstractJob::class,
            VisitJob::create()
        );
    }

    public function testShouldCreateJobWithEmptyData() : void
    {
        $job = VisitJob::create();
        $this->assertEmpty(
            $job->getData()
        );
    }

    public function testShouldCreateJobWithData() : void
    {
        $mockEntity = JobEntityMock::create(VisitJob::TYPE);
        $job = VisitJob::create();
        $job->setData($mockEntity);

        $this->assertNotEmpty(
            $job->getData()
        );
    }

    public function testShouldCreateNullJob() : void
    {
        $this->assertInstanceOf(
            NullJob::class,
            NullJob::create()
        );
    }

    public function testShouldReturnJobUser() : void
    {
        $mockEntity = JobEntityMock::create(VisitJob::TYPE);
        $job = VisitJob::create();
        $job->setData($mockEntity);

        $this->assertNotEmpty(
            $job->getData()->getUser()
        );
    }

    public function testShouldReturnSpecificJobUser() : void
    {
        $mockEntity = JobEntityMock::create(VisitJob::TYPE, UserType::BOSS);
        $job = VisitJob::create();
        $job->setData($mockEntity);

        $this->assertSame(
            UserType::BOSS,
            $job->getData()->getUser()
        );
    }

    public function testShouldReturnUserNotAllowedException() : void
    {
        $this->expectException(
            NotAllowedUserException::class
        );

        JobEntityMock::create(VisitJob::TYPE, 'test');
    }

    public function testShouldReturnTypeNotAllowedException() : void
    {
        $this->expectException(
            NotAllowedTypeException::class
        );

        JobEntityMock::create( 'test');
    }
}