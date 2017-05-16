<?php

namespace CSP\Domain\User\Service;

use CSP\Domain\User\Entity\User;
use CSP\Domain\User\Exception\UserAlreadyExistsException;
use CSP\Domain\User\Repository\UserRepositoryInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class SignupService implements SignupServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signup(string $email, string $password, string $refererEmail = null)
    {
        $user = new User();
        $user
            ->setEmail($email)
            ->setPassword($password)
            ->setActive(true);

        $userReferer = $this->userRepository->findOneBy(array('email' => $refererEmail));

        if (!empty($userReferer)) {
            $user->setUserReferer($userReferer);
        }

        try {
            $this->userRepository->save($user);
        } catch (UniqueConstraintViolationException $e) {
            throw new UserAlreadyExistsException($user);
        }

        return $user;
    }
}
