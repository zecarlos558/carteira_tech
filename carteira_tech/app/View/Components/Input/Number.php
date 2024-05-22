<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Number extends Component
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
    public $step;
    public $min;
    public $max;

   public function __construct($id,$name,$value=null,$placeholder=null,$step=null,$min=null,$max=null)
   {
       $this->value = $value;
       $this->name = $name;
       $this->id = $id;
       $this->placeholder = $placeholder;
       $this->step = $step;
       $this->min = $min;
       $this->max = $max;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.number');
    }
}
