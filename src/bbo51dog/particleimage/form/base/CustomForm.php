<?php

namespace bbo51dog\particleimage\form\base;

abstract class CustomForm extends Form{

    protected $data = [
        "type" => "custom_form",
        "title" => "",
        "content" => [],
    ];

    public function setTitle(string $title){
        $this->data["title"] = $title;
    }

    private function add(array $content): void{
        $this->data["content"][] = $content;
    }

    public function addInput(string $text, string $default = "", string $placeholder = ""): void{
        $input = [
            "type" => "input",
            "text" => $text,
            "default" => $default,
            "placeholder" => $placeholder,
        ];
        $this->add($input);
    }

    public function addStepSlider(string $text, array $steps, ?int $default = null): void{
        $slider = [
            "type" => "step_slider",
            "text" => $text,
            "steps" => $steps,
        ];
        if(isset($default)){
            $slider["default"] = $default;
        }
        $this->add($slider);
    }

    public function addSlider(string $text, int $min, int $max, ?int $default = null): void{
        $slider = [
            "type" => "slider",
            "text" => $text,
            "min" => $min,
            "max" => $max,
        ];
        if(isset($default)){
            $slider["default"] = $default;
        }
        $this->add($slider);
    }

    public function addToggle(string $text, bool $default = false): void{
        $toggle = [
            "type" => "toggle",
            "text" => $text,
            "default" => $default,
        ];
        $this->add($toggle);
    }

    public function addDropdown(string $text, array $options, ?int $default = null): void{
        $dropdown = [
            "type" => "dropdown",
            "text" => $text,
            "options" => $options,
        ];
        if(isset($default)){
            $dropdown["default"] = $default;
        }
        $this->add($dropdown);
    }

    public function addLabel(string $text): void{
        $label = [
            "type" => "label",
            "text" => $text,
        ];
        $this->add($label);
    }
}
