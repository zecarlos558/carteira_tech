<?php

namespace App\View\Components\Chart;

use Illuminate\View\Component;

class Bar_chart extends Component
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
        return view('components.chart.bar_chart');
    }
}
