<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Validacao_erros extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $erros;

    public function __construct($erros=null)
    {
        $this->erros = $erros;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.validacao_erros');
    }
}
