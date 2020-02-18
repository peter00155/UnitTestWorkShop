<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 15.10.19
 * Time: 08:19
 */

namespace Core\VO;


use Core\Users\UserType;
use Core\VO\Exception\NotAllowedUserException;

class UserVO
{

    private $allowedUsers = [
        UserType::BOSS,
        UserType::CUSTOMER,
        UserType::EMPLOYEE,
        UserType::NULL // for tests purpose
    ];
    /**
     * @var string
     */
    private $user;

    public function __construct(string $user)
    {
        if(!in_array($user, $this->allowedUsers)) {
            throw new NotAllowedUserException('Not allowed type');
        }

        $this->user = $user;
    }

    public static function create(string $user)
    {
        return new static($user);
    }

    public function __toString()
    {
        return $this->user;
    }
}