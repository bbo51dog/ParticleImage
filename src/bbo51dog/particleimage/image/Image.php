<?php

namespace bbo51dog\particleimage\image;

use bbo51dog\particleimage\Main;
use function array_merge;
use function array_reverse;
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

    /** @var int[][] */
    private $colors = [];

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
        $resource = $this->trimImage(imagecreatefromstring(file_get_contents($this->path)));
        $width = imagesx($resource);
        $height = imagesy($resource);
        $x = 0;
        $space = self::IMAGE_SIDE_LENGTH / (Main::BLOCK_LENGTH * Main::PARTICLE_NUM_PER_BLOCK);
        for( ; $x < $width; $x += $space){
            $y = 0;
            $colorsCache = [];
            for( ; $y < $height; $y += $space){
                $rgba = imagecolorat($resource, $x, $y);
                $colorsCache[] = [
                    'r' => ($rgba >> 16) & 0xFF,
                    'g' => ($rgba >> 8) & 0xFF,
                    'b' => $rgba & 0xFF,
                ];
            }
            $this->colors = array_merge($this->colors, array_reverse($colorsCache));
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
        $new = imagecreatetruecolor(self::IMAGE_SIDE_LENGTH, self::IMAGE_SIDE_LENGTH);
        imagealphablending($new, false);
        imagesavealpha($new, true);
        imagecopyresampled($new, $resource, 0, 0, $diffX, $diffY, self::IMAGE_SIDE_LENGTH, self::IMAGE_SIDE_LENGTH, $diffW, $diffH);
        return $new;
    }
}