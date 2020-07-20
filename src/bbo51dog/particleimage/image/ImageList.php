<?php

namespace bbo51dog\particleimage\image;

use Exception;
use function basename;
use function in_array;

class ImageList{

    /** @var Image[] */
    private $images;

    public function registerImage(string $path): void{
        $name = basename($path);
        if($this->exists($name)){
            throw new Exception("Image {$name} is already registered");
        }
        $this->images[] = new Image($path);
    }

    public function exists(string $name): bool{
        return in_array($name, $this->images);
    }
}