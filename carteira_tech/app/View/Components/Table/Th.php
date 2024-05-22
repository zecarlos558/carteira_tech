<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Th extends Component
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
