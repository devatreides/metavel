<?php

namespace Tombenevides\Metavel\Components;

use Illuminate\View\Component;
use Tombenevides\Metavel\Traits\UrlGenerator;

class Question extends Component
{
    use UrlGenerator;

    private string $type = 'question';

    public function __construct(
        public ?int $resource = null,
        public array $params = [],
        public bool $bordered = true,
        public bool $titled = true,
        public int $width = 1366,
        public int $height = 768,
    ){}

    public function render()
    {
        $url = $this->getUrl($this->type, $this->resource, $this->params, $this->bordered, $this->titled);

        return view('metavel::question', [
            'url' => $url,
            'width' => $this->width,
            'height' => $this->height,
        ]);
    }
}