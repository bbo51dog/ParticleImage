<?php

namespace bbo51dog\particleimage\image;

use bbo51dog\particleimage\Main;
use function file_get_contents;
use function imagecolorat;
use function imagecreatefromstring;
use function imagesx;
use function imagesy;

class Image{

    public const IMAGE_SIDE_LENGTH = 120;

    /** @var string */
    private $path;

    /** @var string */
    private $name;

    /** @var resource */
    private $resource;

    /** @var int[][] */
    private $colors;

    /**
     * Image constructor.
     * @param string $path
     */
    public function __construct(string $path, string $name){
        $this->path = $path;
        $this->name = $name;
        $this->loadImage();
    }

    /**
     * @return string
     */
    public function getName(): string{
        return $this->name;
    }

    /**
     * @return int[][]
     */
    public function getColors(): array{
        return $this->colors;
    }

    private function loadImage(){
        $this->resource = $this->trimImage(imagecreatefromstring(file_get_contents($this->path)));
        $width = imagesx($this->resource);
        $height = imagesy($this->resource);
        $x = 0;
        $space = self::IMAGE_SIDE_LENGTH / (Main::BLOCK_LENGTH * Main::PARTICLE_NUM_PER_BLOCK);
        for( ; $x < $width; $x += $space){
            $y = 0;
            for( ; $y < $height; $y += $space){
                $rgb = imagecolorat($this->resource, $x, $y);
                $this->colors[] = [
                    'r' => ($rgb >> 16) & 0xFF,
                    'g' => ($rgb >> 8) & 0xFF,
                    'b' => $rgb & 0xFF,
                ];
            }
        }
    }

    private function trimImage($resource) {
        $w = imagesx($resource);
        $h = imagesy($resource);
        if($w > $h){
            $diff  = ($w - $h) * 0.5;
            $diffW = $h;
            $diffH = $h;
            $diffY = 0;
            $diffX = $diff;
        }elseif($w < $h){
            $diff  = ($h - $w) * 0.5;
            $diffW = $w;
            $diffH = $w;
            $diffY = $diff;
            $diffX = 0;
        }elseif($w === $h){
            $diffW = $w;
            $diffH = $h;
            $diffY = 0;
            $diffX = 0;
        }
        $thumbnail = imagecreatetruecolor(self::IMAGE_SIDE_LENGTH, self::IMAGE_SIDE_LENGTH);
        imagecopyresampled($thumbnail, $resource, 0, 0, $diffX, $diffY, self::IMAGE_SIDE_LENGTH, self::IMAGE_SIDE_LENGTH, $diffW, $diffH);
        return $thumbnail;
    }
}