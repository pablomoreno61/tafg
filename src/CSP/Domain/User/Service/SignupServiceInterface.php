<?php

namespace CSP\Domain\User\Service;

interface SignupServiceInterface
{
    public function signup(string $email, string $password);
}