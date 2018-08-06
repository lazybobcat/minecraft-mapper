<?php

namespace App\Map\Action;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

interface ActionInterface
{
    public function execute(ImageManager $imageManager, Image $baseImage);
}