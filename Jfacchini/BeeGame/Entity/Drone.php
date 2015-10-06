<?php

namespace Jfacchini\BeeGame\Entity;

class Drone extends AbstractBee
{
    const MAX_HIT_POINTS = 50;

    const POINTS_LOST = 12;

    public function getMaxHitPoints()
    {
        return self::MAX_HIT_POINTS;
    }

    public function getPointsLost()
    {
        return self::POINTS_LOST;
    }

    public function getName()
    {
        return 'Drone';
    }
}