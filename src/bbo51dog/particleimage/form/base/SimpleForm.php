<?php

namespace bbo51dog\particleimage\form\base;

abstract class SimpleForm extends Form{

    /** @var int */
    public const IMAGE_NONE = 0;
    public const IMAGE_PATH = 1;
    public const IMAGE_URL = 2;

    protected $data = [
        "type" => "form",
        "title" => "",
        "content" => "",
        "buttons" => [],
    ];

    private $types = [
        SimpleForm::IMAGE_PATH => "path",
        SimpleForm::IMAGE_URL => "url",
    ];

    public function setTitle(string $title){
        $this->data["title"] = $title;
    }

    public function setContent(string $text): void{
        $this->data["content"] = $text;
    }
    
    /**
     * @param string $text
     * @param string $image_data Image's path or url
     * @param int $image_type
     */
    public function addButton(string $text, string $image_data = "", int $image_type = self::IMAGE_NONE): void{
        $button["text"] = $text;
        if(!empty($image_data) and !empty($this->types[$image_type])){
            $button["image"]["type"] = $this->types[$image_type];
            $button["image"]["data"] = $image_data;
        }
        $this->data["buttons"][] = $button;
    }
}
