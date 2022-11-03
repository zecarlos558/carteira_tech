<?php

namespace App\View\Components\div;

use Illuminate\View\Component;

class form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $action;
    public $method;
    public $id;

    public function __construct($action,$method,$id=null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.form');
    }
}
