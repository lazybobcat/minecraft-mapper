<?php

namespace App\Map\Action;

use App\Map\Coord;
use Intervention\Image\AbstractFont;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class DrawTextAction implements ActionInterface
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var Coord
     */
    public $position;

    /**
     * @var int
     */
    public $size;

    public function __construct(string $text, Coord $position = null, $size = 8)
    {
        $this->text = $text;
        $this->position = $position ?: new Coord();
        $this->size = round($size);
    }

    public function execute(ImageManager $imageManager, Image $baseImage)
    {
        $baseImage->text($this->text, round($this->position->x), round($this->position->z), function ($font) {
            /** @var AbstractFont $font */
            $font->size($this->size);
            $font->file(3);
            $font->align('center');
            $font->color('#F00');
        });
    }
}