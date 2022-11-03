<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $value;
    public $name;
    public $id;
    public $onclick;
    public $status;

   public function __construct($id,$name,$value=null,$onclick=null,$status=null)
   {
       $this->value = $value;
       $this->name = $name;
       $this->id = $id;
       $this->onclick = $onclick;
       $this->status = $status;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.checkbox');
    }
}
