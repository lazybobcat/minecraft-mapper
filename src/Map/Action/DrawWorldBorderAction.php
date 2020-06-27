<?php

namespace App\Map\Action;

use App\Map\Coord;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class DrawWorldBorderAction implements ActionInterface
{
    /**
     * @var Coord
     */
    private $topLeft;

    /**
     * @var Coord
     */
    private $bottomRight;

    public function __construct(Coord $topLeft, Coord $bottomRight)
    {
        $this->topLeft = $topLeft;
        $this->bottomRight = $bottomRight;
    }

    public function execute(ImageManager $imageManager, Image $baseImage)
    {
        $baseImage->rectangle(round($this->topLeft->x), round($this->topLeft->z), round($this->bottomRight->x), round($this->bottomRight->z), function ($draw) {
            $draw->border(10, '#F00');
        });
    }
}
