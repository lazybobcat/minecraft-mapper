<?php

namespace App\Entity\Traits;

use App\Map\Coord;

trait CoordHolder
{
    /**
     * @var Coord
     *
     * @ORM\Column(name="coords", type="string", nullable=false)
     */
    protected $coords = '0,0,0';

    /**
     * @return Coord
     */
    public function getCoords()
    {
        return Coord::fromArray(explode(',', $this->coords));
    }

    /**
     * @param Coord $coords
     */
    public function setCoords($coords)
    {
        if ($coords instanceof Coord) {
            $this->coords = (string)$coords;
        } else {
            $this->coords = $coords;
        }

        return $this;
    }
}