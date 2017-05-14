<?php

namespace CSP\Domain\User\Entity;

use CSP\Infrastructure\Date\Entity\History;

class User extends History
{
    private $id;

    private $username;

    private $email;

    private $password;

    private $rankScore = 0;

    private $lastLoginAt;

    private $consecutiveLogins = 0;

    private $nickname;

    private $avatar;

    private $isActive = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRankScore()
    {
        return $this->rankScore;
    }

    /**
     * @param mixed $rankScore
     * @return User
     */
    public function setRankScore(int $rankScore)
    {
        $this->rankScore = $rankScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastLoginAt()
    {
        return $this->lastLoginAt;
    }

    /**
     * @param mixed $lastLoginAt
     * @return User
     */
    public function setLastLoginAt(\DateTime $lastLoginAt)
    {
        $this->lastLoginAt = $lastLoginAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConsecutiveLogins()
    {
        return $this->consecutiveLogins;
    }

    /**
     * @param mixed $consecutiveLogins
     * @return User
     */
    public function setConsecutiveLogins(int $consecutiveLogins)
    {
        $this->consecutiveLogins = $consecutiveLogins;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     * @return User
     */
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     * @return User
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return User
     */
    public function setActive(bool $isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }


}