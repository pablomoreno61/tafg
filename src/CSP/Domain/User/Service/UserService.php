<?php

namespace CSP\Domain\User\Service;

use CSP\Domain\User\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findUser(int $userId)
    {
        return $this->userRepository->findUser($userId);
    }
}