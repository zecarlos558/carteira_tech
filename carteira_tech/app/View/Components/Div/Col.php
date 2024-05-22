<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Col extends Component
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
        if ($type == 'auto') {
            $this->type = '-'.$type;
        } elseif ($type!=null && ((int) $type)!= 0) {
            $this->type = '-'.$type;
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
        return view('components.div.col');
    }
}
