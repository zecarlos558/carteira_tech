<?php

namespace App\View\Components\Chart;

use Illuminate\View\Component;

class Doughnut extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $array;
    public $id;

    public function __construct($array, $id = null)
    {
        $this->array = is_array($array) ? json_encode($array) : $array;
        $this->id = $id;
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
