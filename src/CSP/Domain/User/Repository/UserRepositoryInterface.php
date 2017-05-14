<?php

namespace CSP\Domain\User\Repository;

use CSP\Domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user);
}