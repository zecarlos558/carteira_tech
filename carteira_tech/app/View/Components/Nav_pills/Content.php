<?php

namespace App\View\Components\Nav_pills;

use Illuminate\View\Component;

class Content extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $type;

    public function __construct($id,$type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav_pills.content');
    }
}
