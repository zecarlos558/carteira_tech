<?php

namespace App\View\Components\div;

use Illuminate\View\Component;

class filtroEntradaRelatorio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $relatorioEntradaSinteticos;
    public $relatorioEntradas;

   public function __construct($relatorioEntradaSinteticos,$relatorioEntradas)
   {
       $this->relatorioEntradaSinteticos = $relatorioEntradaSinteticos;
       $this->relatorioEntradas = $relatorioEntradas;

   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.filtro-entrada-relatorio');
    }
}
