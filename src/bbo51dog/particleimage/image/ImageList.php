<?php

namespace bbo51dog\particleimage\image;

use Exception;
use function in_array;
use function pathinfo;
use const PATHINFO_FILENAME;

class ImageList{

    /** @var Image[] */
    private $images = [];

    public function registerImage(string $path): void{
        $name = pathinfo($path, PATHINFO_FILENAME);
        if($this->exists($name)){
            throw new Exception("Image {$name} is already registered");
        }
        $this->images[] = new Image($path, $name);
    }

    public function exists(string $name): bool{
        return in_array($name, $this->images);
    }

    /**
     * @return Image[]
     */
    public function getAllImage(): array{
        return $this->images;
    }

    public function getImage(string $name): Image{
        if(!$this->exists($name)){
            throw new Exception("Image {$name} not found");
        }
        return $this->images[$name];
    }
}