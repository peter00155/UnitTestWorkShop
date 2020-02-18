<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 11.10.19
 * Time: 22:12
 */

namespace Core\Jobs;

use Core\VO\TypeVO;
use Core\VO\UserVO;

class JobEntityMock
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $user;

    private function __construct(string $type, string $user)
    {
        $this->type = (string)TypeVO::create($type);
        $this->user = (string)UserVO::create($user);
    }

    public static function create(string $type, string $user = 'customer')
    {
        return new static($type, $user);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }


}