<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 15.10.19
 * Time: 08:12
 */

namespace Core\VO;

use Core\Jobs\Mailing\MailingJob;
use Core\Jobs\Null\NullJob;
use Core\Jobs\Visit\VisitJob;
use Core\VO\Exception\NotAllowedTypeException;

class TypeVO
{
    /**
     * @var string
     */
    private $type;

    private $allowedTypes = [
        VisitJob::TYPE,
        MailingJob::TYPE,
        'asd' // for tests purpose
    ];

    public function __construct(string $type)
    {
        if(!in_array($type, $this->allowedTypes)) {
            throw new NotAllowedTypeException('Not allowed type');
        }

        $this->type = $type;
    }

    public static function create(string $type)
    {
        return new static($type);
    }

    public function __toString()
    {
        return $this->type;
    }
}