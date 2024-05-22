<?php

namespace App\View\Components\Div;

use App\Models\Bairro;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\View\Component;

class Endereco extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $endereco;
    public $estados;

    public function __construct($endereco=null)
    {
        $this->endereco = $endereco;
        $this->estados = Estado::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.endereco');
    }
}
