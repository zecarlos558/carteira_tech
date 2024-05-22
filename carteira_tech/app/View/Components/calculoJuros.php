<?php

namespace App\View\Components;

use Illuminate\View\Component;

class calculoJuros extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $idSaida;
    public $idPagamento;

    public function __construct($idSaida,$idPagamento)
    {
        $this->idSaida = $idSaida;
        $this->idPagamento = $idPagamento;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.calculo-juros');
    }
}
