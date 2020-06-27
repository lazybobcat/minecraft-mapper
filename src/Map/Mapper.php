<?php

namespace App\Map;

use App\Map\Action\ActionInterface;
use App\Map\Action\DrawImageAction;
use App\Map\Action\DrawTextAction;
use App\Map\Action\DrawWorldBorderAction;
use App\Mojang\MojangAPI;
use Impulze\Bundle\InterventionImageBundle\ImageManager;

class Mapper
{
    /**
     * @var Printer
     */
    protected $printer;

    /**
     * @var MojangAPI
     */
    private $mojangAPI;

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
     * @var Coord
     */
    private $centerCoords;

    /**
     * @var array
     */
    private $imageSize;

    /**
     * @var float
     */
    private $blockSizeInPixels;

    /**
     * @var ActionInterface[]
     */
    private $actions = [];

    /**
     * @var string
     */
    private $resourcesDir;

    /**
     * @var string
     */
    private $outputDir;

    public function __construct(ImageManager $imageManager, MojangAPI $mojangAPI, $map, $topLeftCoords, $bottomRightCoords, $centerCoords, $resourcesDir, $outputDir)
    {
        $this->map = $map;
        $this->imageSize = getimagesize($this->map);

        $topLeftCoords = explode(',', $topLeftCoords);
        $this->topLeftCoords = Coord::fromArray($topLeftCoords);

        $bottomRightCoords = explode(',', $bottomRightCoords);
        $this->bottomRightCoords = Coord::fromArray($bottomRightCoords);

        $centerCoords = explode(',', $centerCoords);
        $this->centerCoords = Coord::fromArray($centerCoords);

        // Computing coeffs
        $this->blockSizeInPixels = $this->imageSize[0] / ($this->bottomRightCoords->x - $this->topLeftCoords->x);

        // Printer
        $this->printer = new Printer($imageManager, $map);
        $this->mojangAPI = $mojangAPI;
        $this->resourcesDir = $resourcesDir;
        $this->outputDir = $outputDir;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    public function getResult($filename = 'map.png')
    {
        $path = $this->outputDir . DIRECTORY_SEPARATOR . $filename;
        $img = $this->printer->execute($this->actions);
        $img->save($path);

        return $path;
    }

    /**
     * @param string $playerName
     * @param Coord $baseCoords
     * @param int $headSize
     */
    public function addPlayerHead($playerName, Coord $baseCoords, $headSize = 8, $nameSize = 8)
    {
        $uuid = $this->mojangAPI->getUuid($playerName);
        $file = $this->outputDir . DIRECTORY_SEPARATOR . 'PLAYER_HEAD_' . $playerName . '.png';

        if (file_exists($file)) {
            $head = file_get_contents($file);
        } else {
            $head = $this->mojangAPI->getPlayerHead($uuid);
        }

        if (!empty($head)) {
            file_put_contents($file, $head);
        } else {
            $head = $this->mojangAPI->getSteveHead();
            $file = tempnam(sys_get_temp_dir(), 'PLAYER_HEAD_');
            file_put_contents($file, $head);
        }

        $position = $this->blockToPixelCoords($baseCoords);
        $pxTextPosition = clone $position;
        $pxTextPosition->z += $headSize;
        $pxHeadPosition = Coord::sub($position, new Coord($headSize/2, 0, $headSize/2));

        $this->actions[] = new DrawImageAction($file, $pxHeadPosition, $headSize);
        $this->actions[] = new DrawTextAction($playerName, $pxTextPosition, $nameSize);
    }

    public function addPointOfInterest($name, $type, Coord $coords, $size = 8, $nameSize = 8)
    {
        $file = $this->resourcesDir . DIRECTORY_SEPARATOR . $type . '.png';
        $position = $this->blockToPixelCoords($coords);
        $pxImagePosition = Coord::sub($position, new Coord($size/2, 0, $size/2));
        $pxTextPosition = clone $position;
        $pxTextPosition->z += $size;

        $this->actions[] = new DrawImageAction($file, $pxImagePosition, $size);
        $this->actions[] = new DrawTextAction($name, $pxTextPosition, $nameSize);
    }

    public function addWorldBorder($radius = 5000)
    {
        $blockTopLeft = new Coord($this->centerCoords->x - $radius, 63, $this->centerCoords->z - 5000);
        $blockBottomRight = new Coord($this->centerCoords->x + $radius, 63, $this->centerCoords->z + 5000);
        $topLeft = $this->blockToPixelCoords($blockTopLeft);
        $bottomRight = $this->blockToPixelCoords($blockBottomRight);
        $this->actions[] = new DrawWorldBorderAction($topLeft, $bottomRight);
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
