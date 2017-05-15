<?php

namespace CSP\Domain\User\Repository;

use CSP\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user);

    public function login(string $email, string $password);

    public function findUser(int $userId);
}