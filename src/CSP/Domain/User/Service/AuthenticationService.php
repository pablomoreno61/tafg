<?php

namespace CSP\Domain\User\Service;

use CSP\Domain\User\Exception\UserDoesNotExistsException;
use CSP\Domain\User\Repository\UserRepositoryInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password)
    {
        $user = $this->userRepository->login($email, $password);

        if (!$user) {
            throw new UserDoesNotExistsException($email);
        }

        return $user;
    }

    public function logout(int $userId)
    {

    }
}