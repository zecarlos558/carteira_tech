<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $id;
    public $onchange;

   public function __construct($id,$name,$onchange=null)
   {
       $this->name = $name;
       $this->id = $id;
       $this->onchange = $onchange;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.select');
    }
}
