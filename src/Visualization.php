<?php

namespace Tombenevides\Metavel;

use Illuminate\View\Component;

class Visualization extends Component
{
    protected string $type;

    private UrlGenerator $generator;

    public function __construct(
        public int $resource,
        public array $params = [],
        public bool $bordered = true,
        public bool $titled = true,
        public bool $darkTheme = false,
        public int $width = 1366,
        public int $height = 768,
        public ?string $style = null,
    ){
        $this->generator = new UrlGenerator;
    }

    public function render()
    {
        $url = $this->generator->getUrl(
            $this->type, 
            $this->resource, 
            $this->params, 
            $this->bordered, 
            $this->titled,
            $this->darkTheme ? 'night' : 'day'
        );

        return view("metavel::visualization", [
            'url' => $url,
            'width' => $this->width,
            'height' => $this->height,
            'style' => $this->style,
        ]);
    }
}