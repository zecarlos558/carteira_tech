<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Movimento extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $movimentos;

   public function __construct($movimentos)
   {
       $this->movimentos = $movimentos;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.movimento');
    }
}
