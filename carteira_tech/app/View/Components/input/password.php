<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class password extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $value;
    public $name;
    public $id;
    public $placeholder;
    public $onclick;

   public function __construct($id,$name,$value=null,$placeholder=null,$onclick=null)
   {
       $this->value = $value;
       $this->name = $name;
       $this->id = $id;
       $this->placeholder = $placeholder;
       $this->onclick = $onclick;
   }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.password');
    }
}
