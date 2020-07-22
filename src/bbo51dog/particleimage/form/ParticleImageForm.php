<?php

namespace bbo51dog\particleimage\form;

use bbo51dog\particleimage\form\base\SimpleForm;
use bbo51dog\particleimage\image\Image;
use bbo51dog\particleimage\image\ImageList;
use bbo51dog\particleimage\Main;
use pocketmine\level\particle\DustParticle;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ParticleImageForm extends SimpleForm{

    /** @var Image[] */
    private $images = [];

    /**
     * ParticleImageForm constructor.
     * @param ImageList $imageList
     */
    public function __construct(ImageList $imageList){
        $this->setTitle(TextFormat::GREEN . 'ParticleImage Form');
        foreach($imageList->getAllImage() as $image){
            $this->addButton($image->getName());
            $this->images[] = $image;
        }
    }

    public function handleResponse(Player $player, $data): void{
        if($data === null){
            return;
        }
        $image = $this->images[$data];
        $xCount = 0;
        $zCount = 0;
        $level = $player->getLevel();
        foreach($image->getColors() as $rgb){
            if($xCount > (Main::BLOCK_LENGTH * Main::PARTICLE_NUM_PER_BLOCK) - 1){
                $xCount = 0;
                $zCount++;
            }
            $particle = new DustParticle(
                new Vector3(
                    $player->x + $xCount / Main::PARTICLE_NUM_PER_BLOCK - Main::BLOCK_LENGTH / 2,
                    $player->y - 3,
                    $player->z + $zCount / Main::PARTICLE_NUM_PER_BLOCK - Main::BLOCK_LENGTH / 2
                ),
                $rgb['r'],
                $rgb['g'],
                $rgb['b']
            );
            $xCount++;
            $level->addParticle($particle);
        }
    }
}