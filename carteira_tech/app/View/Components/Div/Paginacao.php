<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Paginacao extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.paginacao');
    }
}
