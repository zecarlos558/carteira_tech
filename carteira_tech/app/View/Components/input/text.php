<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class text extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $name;
     public $id;
     public $value;
     public $placeholder;
     public $onclick;
     public $onkeyup;

    public function __construct($id,$name,$value=null,$placeholder=null,$onclick=null,$onkeyup=null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->onclick = $onclick;
        $this->onkeyup = $onkeyup;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.text');
    }
}
