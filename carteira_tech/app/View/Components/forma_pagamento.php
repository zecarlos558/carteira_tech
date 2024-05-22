<?php

namespace App\View\Components;

use App\Models\Plano_pagamento;
use Illuminate\View\Component;

class forma_pagamento extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $planos;

    public function __construct($planos)
    {
        $this->planos = $planos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forma_pagamento');
    }
}
