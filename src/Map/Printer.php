<?php

namespace App\Map;

use App\Map\Action\ActionInterface;
use Impulze\Bundle\InterventionImageBundle\ImageManager;
use Intervention\Image\Image;

class Printer
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @var Image
     */
    private $background;

    public function __construct(ImageManager $imageManager, string $background)
    {
        $this->imageManager = $imageManager;
        $this->background = $this->imageManager->make($background);
    }

    /**
     * @param ActionInterface[] $actions
     *
     * @return Image
     */
    public function execute(array $actions)
    {
        foreach ($actions as $action) {
            $action->execute($this->imageManager, $this->background);
        }

        return $this->background;
    }
}