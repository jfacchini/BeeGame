<?php

namespace Jfacchini\BeeGame\Entity;

interface InterfaceBee
{
    public function hit();

    public function resetLife();

    /**
     * @return int
     */
    public function getMaxHitPoints();

    /**
     * @return int
     */
    public function getPointsLost();

    /**
     * @return bool
     */
    public function isDead();

    /**
     * @return string
     */
    public function getName();
}