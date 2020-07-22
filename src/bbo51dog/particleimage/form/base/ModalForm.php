<?php

namespace bbo51dog\particleimage\form\base;

abstract class ModalForm extends Form{

    protected $data = [
        "type" => "modal",
        "title" => "",
        "content" => "",
        "button1" => "",
        "button2" => "",
    ];

    public function setTitle(string $title){
        $this->data["title"] = $title;
    }

    public function setContent(string $text): void{
        $this->data["content"] = $text;
    }

    public function setButtonOne(string $text): void{
        $this->data["button1"] = $text;
    }

    public function setButtonTwo(string $text): void{
        $this->data["button2"] = $text;
    }
}
