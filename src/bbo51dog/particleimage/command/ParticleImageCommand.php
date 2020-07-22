<?php

namespace bbo51dog\particleimage\command;

use bbo51dog\particleimage\form\ParticleImageForm;
use bbo51dog\particleimage\image\ImageList;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ParticleImageCommand extends Command{

    /** @var ImageList */
    private $imageList;

    /**
     * ParticleImageCommand constructor.
     * @param ImageList $imageList
     */
    public function __construct(ImageList $imageList){
        parent::__construct('pimage');
        $this->setPermission('particleimage.command.pimage');
        $this->imageList = $imageList;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$sender instanceof Player){
            $sender->sendMessage(TextFormat::RED . 'Please use this command in server');
            return;
        }
        (new ParticleImageForm($this->imageList))->send($sender);
    }
}