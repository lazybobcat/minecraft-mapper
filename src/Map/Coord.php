<?php

namespace App\Map;


class Coord
{
    /**
     * @var float
     */
    public $x;

    /**
     * @var float
     */
    public $y;

    /**
     * @var float
     */
    public $z;

    public function __construct($x = 0, $y = 0, $z = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function __toString()
    {
        return "{$this->x},{$this->y},{$this->z}";
    }

    /**
     * @param array $coords
     *
     * @return Coord
     */
    public static function fromArray(array $coords)
    {
        if (count($coords) === 3) {
            return new Coord(intval($coords[0]), intval($coords[1]), intval($coords[2]));
        } elseif (count($coords) === 2) {
            return new Coord(intval($coords[0]), 63, intval($coords[1]));
        } else {
            throw new \LogicException("Invalid coordinates format. Should be '<x>,<y>,<z>'");
        }
    }

    public static function sub(Coord $left, Coord $right)
    {
        return new Coord($left->x - $right->x, $left->y, $left->z - $right->z);
    }

    public static function add(Coord $left, Coord $right)
    {
        return new Coord($left->x + $right->x, $left->y, $left->z + $right->z);
    }
}