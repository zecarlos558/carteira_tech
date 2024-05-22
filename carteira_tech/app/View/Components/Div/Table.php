<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $idTabela;

    public function __construct($id='tabelaItens_overflow',$idTabela='tabela')
    {
        $this->id = $id;
        $this->idTabela = $idTabela;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.table');
    }
}
