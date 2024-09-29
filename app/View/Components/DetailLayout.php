<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DetailLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  array<string>  $routes
     */
    public function __construct(
        public mixed $item,
        public array $routes,
        public string $title,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.detail-layout', [
            'item' => $this->item,
            'routes' => $this->routes,
            'title' => $this->title,
        ]);
    }
}
