<?php

namespace Jfacchini\BeeGame\Game;

use Jfacchini\BeeGame\Entity\AbstractBee;
use Jfacchini\BeeGame\Entity\Drone;
use Jfacchini\BeeGame\Entity\Queen;
use Jfacchini\BeeGame\Entity\Worker;

class BeeGame
{
    private $bees;

    private $jsonBeesFile;

    /**
     * @param string $jsonBeesFile
     */
    public function __construct($jsonBeesFile)
    {
        if (!file_exists($jsonBeesFile)) {
            touch($jsonBeesFile);
            file_put_contents($jsonBeesFile, json_encode(array()));
        }

        $this->jsonBeesFile = $jsonBeesFile;
    }

    public function save()
    {
        $jsonArray = [];
        /** @var AbstractBee $bee */
        foreach ($this->bees as $bee) {
            $jsonArray[] = [
                'class' => get_class($bee),
                'hitPoints' => $bee->getHitPoints(),
            ];
        }
        $json = json_encode($jsonArray);
        file_put_contents($this->jsonBeesFile, $json);
    }

    public function read()
    {
        $json = file_get_contents($this->jsonBeesFile);
        $jsonArray = json_decode($json, true);

        $this->bees = [];
        foreach ($jsonArray as $value) {
            /** @var AbstractBee $bee */
            $bee = new $value['class'];
            $bee->setHitPoints($value['hitPoints']);
            $this->bees[] = $bee;
        }
    }

    public function init()
    {
        $this->bees = array();

        $bee = new Queen();
        $bee->resetLife();
        $this->bees[] = $bee;

        for ($i = 0; $i < 5; $i++) {
            $bee = new Worker();
            $bee->resetLife();
            $this->bees[] = $bee;
        }

        for ($i = 0; $i < 8; $i++) {
            $bee = new Drone();
            $bee->resetLife();
            $this->bees[] = $bee;
        }
    }

    /**
     * @return string
     */
    public function start()
    {
        $this->read();

        if (count($this->bees) == 0) {
            $this->init();
        }

        $beesIndex = rand(0, count($this->bees) -1);
        $bee = $this->bees[$beesIndex];

        /** @var AbstractBee $bee */
        $bee->hit();
        if ($bee->isDead()) {
            unset($this->bees[$beesIndex]);

            $reset = false;

            if (count($this->bees) == 0) {
                $result = 'All bees are dead, end of the game<br>';
                $reset = true;
            } elseif ($bee instanceof Queen) {
                $result = 'Queen is dead, end of the game<br>';
                $reset = true;
            } else {
                $result = $bee->getName().' is dead<br>';
            }

            if ($reset) {
                $this->init();
            }
        } else {
            $result = $bee->getName().' bee lost '.$bee->getPointsLost().' hit points<br>';
        }

        $result .= $this->currentStatus();

        $this->save();

        return $result;
    }


    private function currentStatus()
    {
        $status = '';
        /** @var AbstractBee $bee */
        foreach ($this->bees as $bee) {
            $status .= sprintf('Bee %s has %d points<br>', $bee->getName(), $bee->getHitPoints());
        }

        return $status;
    }
}