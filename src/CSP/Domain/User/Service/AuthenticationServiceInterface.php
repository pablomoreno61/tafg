<?php

namespace CSP\Domain\User\Service;

interface AuthenticationServiceInterface
{
    public function login(string $email, string $password);

    public function logout(int $userId);
}
