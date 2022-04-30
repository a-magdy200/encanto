<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableComponent extends Component
{
    public $title = '';
    public $headings = [];
    public $items = [];

    /**
     * @param string $title
     * @param array $headings
     * @param array $items
     */
    public function __construct(string $title = '', array $headings = [], array $items = [])
    {
        $this->title = $title;
        $this->headings = $headings;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-component');
    }
}
