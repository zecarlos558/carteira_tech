<?php

namespace App\View\Components\div;

use Illuminate\View\Component;

class row extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $class;
    public $type;

    public function __construct($class=null,$type=null)
    {
        $this->class = $class;
        if ($type!=null) {
            $this->type = ' '.$type;
        } else {
            $this->type = $type;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.row');
    }
}
