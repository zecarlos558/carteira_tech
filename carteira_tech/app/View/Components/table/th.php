<?php

namespace App\View\Components\table;

use Illuminate\View\Component;

class th extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $scope;

    public function __construct($scope)
    {
        $this->scope = $scope;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.th');
    }
}
