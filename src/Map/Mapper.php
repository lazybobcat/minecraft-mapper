<?php

namespace App\Map;

class Mapper
{
    /**
     * @var string
     */
    private $map;

    /**
     * @var Coord
     */
    private $topLeftCoords;

    /**
     * @var Coord
     */
    private $bottomRightCoords;

    /**
     * @var array
     */
    private $imageSize;

    /**
     * @var float
     */
    private $blockSizeInPixels;

    public function __construct($map, $topLeftCoords, $bottomRightCoords)
    {
        $this->map = $map;
        $this->imageSize = getimagesize($this->map);

        $topLeftCoords = explode(',', $topLeftCoords);
        $this->topLeftCoords = Coord::fromArray($topLeftCoords);

        $bottomRightCoords = explode(',', $bottomRightCoords);
        $this->bottomRightCoords = Coord::fromArray($bottomRightCoords);

        // Computing coeffs
        $this->blockSizeInPixels = $this->imageSize[0] / ($this->bottomRightCoords->x - $this->topLeftCoords->x);
    }

    /**
     * Converts 'block' coordinates in Minecraft world to x,y coordinates on the map image file
     *
     * @param Coord $blockCoords
     *
     * @return Coord
     */
    public function blockToPixelCoords(Coord $blockCoords)
    {
        $pixelCoords = new Coord();
        $blockCoords = Coord::sub($blockCoords, $this->topLeftCoords);

        $pixelCoords->x = round($blockCoords->x * $this->blockSizeInPixels);
        $pixelCoords->z = round($blockCoords->z * $this->blockSizeInPixels);

        return $pixelCoords;
    }
}