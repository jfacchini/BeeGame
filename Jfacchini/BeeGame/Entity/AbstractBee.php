<?php

namespace Jfacchini\BeeGame\Entity;

abstract class AbstractBee implements InterfaceBee
{
    /** @var int */
    private $hitPoints;

    public function __construct()
    {
        $this->hitPoints = 0;
    }

    /**
     * @return int
     */
    public function getHitPoints()
    {
        return $this->hitPoints;
    }

    /**
     * @param int $hitPoints
     * @return AbstractBee
     */
    public function setHitPoints($hitPoints)
    {
        $this->hitPoints = $hitPoints;

        return $this;
    }

    public function resetLife()
    {
        $this->hitPoints = $this->getMaxHitPoints();
    }


    public function hit()
    {
        $this->hitPoints -= $this->getPointsLost();
    }

    /**
     * @return bool
     */
    public function isDead()
    {
        return $this->hitPoints <= 0;
    }
}