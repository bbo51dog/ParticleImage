<?php

namespace bbo51dog\particleimage;

use bbo51dog\particleimage\command\ParticleImageCommand;
use bbo51dog\particleimage\image\ImageList;
use pocketmine\plugin\PluginBase;
use function getimagesize;
use function is_array;
use function is_int;

class Main extends PluginBase{

    /** @var ImageList */
    private $imageList;

    public function onEnable(){
        $this->imageList = new ImageList();
        $this->getLogger()->info('Loading images...');
        foreach(glob($this->getDataFolder() . '*') as $path){
            $info = getimagesize($path);
            if(!is_array($info) || !is_int($info[2])){
                continue;
            }
            $this->imageList->registerImage($path);
        }
        $this->getLogger()->info('Images successfully loaded');

        $this->getServer()->getCommandMap()->register('particleimage', new ParticleImageCommand($this->imageList));
    }
}