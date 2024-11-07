<?php

namespace App\View\Components\Chart;

use Illuminate\View\Component;

class Bar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $array;
    public $tipo;
    public $id;

    public function __construct($array, $id = null, $tipo = 'suprimento')
    {
        $this->array = is_array($array) ? json_encode($array) : $array;
        $this->tipo = $tipo;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chart.bar');
    }
}
