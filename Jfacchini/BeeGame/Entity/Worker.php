<?php

namespace Jfacchini\BeeGame\Entity;

class Worker extends AbstractBee
{
    const MAX_HIT_POINTS = 75;

    const POINTS_LOST = 10;

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
        return 'Worker';
    }
}