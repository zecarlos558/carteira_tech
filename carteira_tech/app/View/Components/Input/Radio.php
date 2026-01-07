<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Radio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $class;
    public $value;
    public $name;
    public $id;

   public function __construct($id,$name,$class=null,$value=null)
   {
       $this->class = $class;
       $this->value = $value;
       $this->name = $name;
       $this->id = $id;

   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.radio');
    }
}
