<?php

namespace App\View\Components\div;

use Illuminate\View\Component;

class filtroSaidaRelatorio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $relatorioSaidaSinteticos;
    public $relatorioSaidas;

   public function __construct($relatorioSaidaSinteticos,$relatorioSaidas)
   {
       $this->relatorioSaidaSinteticos = $relatorioSaidaSinteticos;
       $this->relatorioSaidas = $relatorioSaidas;

   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.filtro-saida-relatorio');
    }
}
