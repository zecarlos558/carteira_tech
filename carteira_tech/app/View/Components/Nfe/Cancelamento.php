<?php

namespace App\View\Components\Nfe;

use Illuminate\View\Component;

class Cancelamento extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $nfe;

    public function __construct($nfe)
    {
        $this->nfe = $nfe;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nfe.cancelamento');
    }
}
