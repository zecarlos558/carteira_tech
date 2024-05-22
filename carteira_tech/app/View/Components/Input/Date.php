<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Date extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $id;
     public $name;

    public function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.date');
    }
}
