<?php

namespace App\Entity;

use App\Entity\Traits\CoordHolder;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="map__point_of_interest")
 */
class PointOfInterest
{
    use CoordHolder;

    const TYPE_TOWN = 'town';
    const TYPE_SPAWN = 'spawn';
    const TYPE_IRON_FARM = 'iron-farm';
    const TYPE_FACTORY = 'factory';
    const TYPE_MINE = 'mine';
    const TYPE_STATION = 'station';
    const TYPE_SWORD = 'sword';
    const TYPE_STEVE = 'steve';
    const TYPE_BENCH = 'bench';
    const TYPE_CARLIN = 'carlin';
    const TYPE_PIG = 'pig';
    const TYPE_SHOVEL = 'shovel';
    const TYPE_DIAMOND = 'diamond';
    const TYPE_ZOMBIE = 'zombie';
    const TYPE_SKELETON = 'skeleton';

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    protected $type;

    public static function getTypes()
    {
        return [
            self::TYPE_TOWN => 'Factory',
            self::TYPE_SPAWN => 'Spawn',
            self::TYPE_IRON_FARM => 'Iron Farm',
            self::TYPE_FACTORY => 'Factory',
            self::TYPE_MINE => 'Mine',
            self::TYPE_STATION => 'Station',
            self::TYPE_SWORD => 'Sword/Combat/PvP',
            self::TYPE_BENCH => 'Building/Crafting table',
            self::TYPE_STEVE => 'Steve',
            self::TYPE_CARLIN => 'Carlin',
            self::TYPE_PIG => 'Pig',
            self::TYPE_SHOVEL => 'Dig Area/Shovel',
            self::TYPE_DIAMOND => 'DIAMOND!',
            self::TYPE_ZOMBIE => 'Zombie',
            self::TYPE_SKELETON => 'Skeleton',
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return PointOfInterest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return PointOfInterest
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}