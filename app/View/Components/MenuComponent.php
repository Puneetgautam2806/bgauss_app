<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\LinkTbl;

class MenuComponent extends Component
{
    public $parentMenus;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch menu structure
        $this->parentMenus = LinkTbl::where('parent_id', null)
            ->where('display', true)
            ->orderBy('order')
            ->with(['children' => function ($query) {
                $query->where('display', true)->orderBy('order');
            }])
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-component');
    }
}
