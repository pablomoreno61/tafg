<?php

namespace CSP\Infrastructure\Date\Entity;

class History
{
    protected $createdAt;

    protected $updatedAt;

    protected $timezone = '';

    public function __construct()
    {
        $this->localized = true;
        $this->createdAt = new \DateTime();
        $this->timezone = $this->createdAt->getTimeZone()->getName();
    }

    /**
     * @var bool
     */
    private $localized = false;

    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
        return $this;
    }

    public function getUpdatedAt()
    {
        if (!empty($this->updatedAt)) {
            $this->updatedAt->settimezone(new \DateTimeZone($this->timezone));
        }

        return $this->updatedAt;
    }

    public function getCreatedAt()
    {
        if (!$this->localized) {
            $this->createdAt->setTimeZone(new \DateTimeZone($this->timezone));
        }
        return $this->createdAt;
    }

    public function updatedLifeCycleDates()
    {
        $this->setUpdatedAt();
    }
}
