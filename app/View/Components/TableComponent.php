<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableComponent extends Component
{
    public $title = '';
    public $headings = [];
    public $items = [];
    public $actions = true;
    public $bannable = false;
    public $resource = '';

    /**
     * @param string $title
     * @param array $headings
     * @param array $items
     */
    public function __construct(string $title = '', string $resource = '', array $headings = [], array $items = [], bool $actions = true, bool $bannable = false)
    {
        $this->title = $title;
        $this->resource = $resource;
        $this->headings = $headings;
        $this->items = $items;
        $this->actions = $actions;
        $this->bannable = $bannable;
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
