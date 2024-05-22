<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $rows;
    public $name;
    public $id;
    public $placeholder;

   public function __construct($id,$name,$rows=null,$placeholder=null)
   {
       $this->rows = $rows;
       $this->name = $name;
       $this->id = $id;
       $this->placeholder = $placeholder;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.textarea');
    }
}
