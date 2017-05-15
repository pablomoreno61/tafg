<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Infrastructure\Date\Entity\History;

class Crew extends History
{
    private $id;

    private $text;

    private $isActive = true;

    private $crewSize = 0;

    private $latestEnrollmentAt;

    private $latestQuitAt;

    private $logo;

    private $crewMembers;

    public function __construct()
    {
        $this->crewMembers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Crew
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Crew
     */
    public function setText($text)
    {
        $this->text = $text;
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
     * @return Crew
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrewSize()
    {
        return $this->crewSize;
    }

    /**
     * @param mixed $crewSize
     * @return Crew
     */
    public function setCrewSize($crewSize)
    {
        $this->crewSize = $crewSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatestEnrollmentAt()
    {
        return $this->latestEnrollmentAt;
    }

    /**
     * @param mixed $latestEnrollmentAt
     * @return Crew
     */
    public function setLatestEnrollmentAt(\DateTime $latestEnrollmentAt)
    {
        $this->latestEnrollmentAt = $latestEnrollmentAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatestQuitAt()
    {
        return $this->latestQuitAt;
    }

    /**
     * @param mixed $latestQuitAt
     * @return Crew
     */
    public function setLatestQuitAt(\DateTime $latestQuitAt)
    {
        $this->latestQuitAt = $latestQuitAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     * @return Crew
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }
}
