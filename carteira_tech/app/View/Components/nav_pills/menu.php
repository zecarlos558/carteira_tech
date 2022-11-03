<?php

namespace App\View\Components\nav_pills;

use Illuminate\View\Component;

class menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $href;

   public function __construct($type,$href)
   {
       $this->type = $type;
       $this->href = '#'.$href;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav_pills.menu');
    }
}
