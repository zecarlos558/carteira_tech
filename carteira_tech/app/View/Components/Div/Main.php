<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $tituloCentral;

    public function __construct($id=null,$tituloCentral=null)
    {
        $this->id = $id;
        $this->tituloCentral = $tituloCentral;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.main');
    }
}
