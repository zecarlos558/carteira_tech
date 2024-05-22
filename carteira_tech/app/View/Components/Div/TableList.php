<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class TableList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $tituloCentral;

    public function __construct($tituloCentral=null)
    {
        $this->tituloCentral = $tituloCentral;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.table-list');
    }
}
