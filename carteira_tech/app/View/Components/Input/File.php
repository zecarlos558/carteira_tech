<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class File extends Component
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
    public $onchange;

   public function __construct($id,$name,$value=null,$placeholder=null,$onchange=null)
   {
       $this->value = $value;
       $this->name = $name;
       $this->id = $id;
       $this->placeholder = $placeholder;
       $this->onchange = $onchange;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.file');
    }
}
