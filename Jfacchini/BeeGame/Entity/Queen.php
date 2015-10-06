<?php

namespace Jfacchini\BeeGame\Entity;


class Queen extends AbstractBee
{
    const MAX_HIT_POINTS = 100;

    const POINTS_LOST = 8;

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
        return 'Queen';
    }
}