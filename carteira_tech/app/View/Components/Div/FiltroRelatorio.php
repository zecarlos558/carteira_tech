<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class FiltroRelatorio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $relatorio;

    public function __construct($relatorio)
    {
        $this->relatorio = $relatorio;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.filtro-relatorio');
    }
}
