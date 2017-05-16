<?php

namespace CSP\Domain\User\Service;

use CSP\Domain\User\Entity\User;
use CSP\Domain\User\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUserById($userId)
    {
        return $this->userRepository->findUserById($userId);
    }

    public function save(User $user)
    {
        $this->userRepository->save($user);
    }
}