<?php

namespace App\View\Components\Div;

use Illuminate\View\Component;

class CenterSearch extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $offset;
    public $offset_options;

    public function __construct()
    {
        if (request('offset')) {
            $offset = request('offset');
            session()->put(['offset' => $offset]);
        } else {
            $offset = session()->get('offset');
        }
        $this->offset = $offset;
        $this->offset_options = [5, 10, 15, 20, 25, 30, 40, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.div.center-search');
    }
}
