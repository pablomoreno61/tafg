<?php

namespace CSP\Infrastructure\User\Repository;

use CSP\Domain\User\Entity\User;
use CSP\Domain\User\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function save(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function login(string $email, string $password)
    {
        return $this->findOneBy(array('email' => $email, 'password' => $password));
    }

    public function findUserById($userId)
    {
        return $this->findOneBy(array('id' => $userId));
    }
}
