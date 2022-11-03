<?php

namespace App\View\Components\button;

use App\Models\Aplication;
use Illuminate\View\Component;

class a extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $icon;

    public function __construct($icon=null)
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //$permissao = Aplication::consultaPermissao();
        if ( ( ($this->icon == 'editar') || ($this->icon == 'deletar')|| ($this->icon == 'criar') ) && ( (Aplication::verificaFuncao('user')) || (Aplication::verificaFuncao('seller')) ) ) {

        } else {
            return view('components.button.a');
        }

    }
}
