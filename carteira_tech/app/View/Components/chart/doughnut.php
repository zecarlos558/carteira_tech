<?php

namespace App\View\Components\chart;

use Illuminate\View\Component;

class doughnut extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chart.doughnut');
    }
}
