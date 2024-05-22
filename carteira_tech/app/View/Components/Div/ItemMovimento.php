<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class ItemMovimento extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $itemMovimentos;

    public function __construct($itemMovimentos)
    {   
        $this->itemMovimentos = $itemMovimentos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.item-movimento');
    }
}
