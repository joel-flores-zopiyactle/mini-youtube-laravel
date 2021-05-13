<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comments extends Component
{

    public $videoId;
    public $comment;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($videoId, $comment)
    {
        $this->videoId = $videoId;
        $this->comment = $comment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comments');
    }
}
