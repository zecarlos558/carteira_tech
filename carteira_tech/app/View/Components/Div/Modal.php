<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $idModal;
    public $idTitulo;

   public function __construct($idModal,$idTitulo)
   {
       $this->idModal = $idModal;
       $this->idTitulo = $idTitulo;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.modal');
    }
}
