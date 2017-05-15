<?php

namespace CSP\Domain\User\Service;

interface UserServiceInterface
{
    public function findUser(int $userId);
}