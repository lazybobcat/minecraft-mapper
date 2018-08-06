<?php

namespace App\Map\Action;

use App\Map\Coord;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class DrawImageAction implements ActionInterface
{
    /**
     * @var string
     */
    public $file;

    /**
     * @var Coord
     */
    public $position;

    /**
     * @var int
     */
    public $size;

    public function __construct(string $file, Coord $position = null, $size = 8)
    {
        $this->file = $file;
        $this->position = $position ?: new Coord();
        $this->size = $size;
    }

    /**
     * @param ImageManager $imageManager
     * @param Image $baseImage
     */
    public function execute(ImageManager $imageManager, Image $baseImage)
    {
        $image = $imageManager->make($this->file);
        $image->resize(round($this->size), round($this->size));
        $baseImage->insert($image, 'top-left', round($this->position->x), round($this->position->z));
    }
}