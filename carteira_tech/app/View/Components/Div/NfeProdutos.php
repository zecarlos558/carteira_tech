<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class NfeProdutos extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dados;
    public $cEAN;
    public $indTot;
    public $orig;
    public $CST;
    public $CSOSN;
    public $modBC;
    public $modBCST;

    public function __construct($dados=null)
    {
        $this->dados = $dados;
        $this->cEAN = ['SEM GTIN', 'GTIN-8', 'GTIN-12', 'GTIN-13', 'GTIN-14'];
        $this->indTot = get_indTot();
        $this->orig = get_orig();
        $this->CST = get_CST();
        $this->CSOSN = get_CSOSN();
        $this->modBC = get_modBC();
        $this->modBCST = get_modBCST();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.nfe-produtos');
    }
}
