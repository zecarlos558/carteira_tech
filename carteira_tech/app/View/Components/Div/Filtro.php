<?php

namespace App\View\Components\Div;

use App\Classes\Filtro as ClassesFiltro;
use Illuminate\View\Component;

class Filtro extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $rota_limpar;
    public $options;

    public function __construct($rota_limpar='#', $options=null, $filtro=null)
    {
        if ( !empty($filtro) && is_a($filtro, 'App\Classes\Filtro') ) {
            $this->rota_limpar = $filtro->getRotaLimpar();
            $this->options = $filtro->getOptions();
        } else {
            $filtro = new ClassesFiltro();
            $this->rota_limpar = $filtro->getRotaLimpar($filtro->setRotaLimpar($rota_limpar));
            $this->options = $filtro->getOptions($filtro->setOptions($options));
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.filtro');
    }
}
