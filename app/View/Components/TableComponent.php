<?php
namespace App\View\Components;

use Illuminate\View\Component;

class TableComponent extends Component
{
    public $title = '';
    public $headings = [];
    public $actions = true;

    /**
     * @param string $title
     * @param array $headings
     * @param array $items
     */
    public function __construct(string $title = '', array $headings = [], bool $actions = true)
    {
        $this->title = $title;
        $this->headings = $headings;
        $this->actions = $actions;
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