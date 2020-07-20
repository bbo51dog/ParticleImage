<?php

namespace bbo51dog\particleimage\image;

class Image{

    /** @var string */
    private $path;

    /**
     * Image constructor.
     * @param string $path
     */
    public function __construct(string $path){
        $this->path = $path;
    }
}