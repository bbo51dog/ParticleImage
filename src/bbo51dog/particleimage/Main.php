<?php

namespace bbo51dog\particleimage;

use bbo51dog\particleimage\image\ImageList;
use pocketmine\plugin\PluginBase;
use function getimagesize;
use function is_array;
use const IMG_JPG;
use const IMG_PNG;

class Main extends PluginBase{

    /** @var ImageList */
    private $imageList;

    public function onEnable(){
        $this->imageList = new ImageList();
        foreach(glob($this->getDataFolder() . '*') as $path){
            $info = getimagesize($path);
            if(is_array($info) && $info[2] !== IMG_PNG && $info[2] !== IMG_JPG){
                continue;
            }
            $this->imageList->registerImage($path);
        }
    }
}