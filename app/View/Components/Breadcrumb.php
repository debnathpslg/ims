<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public string $pageName;
    public array $breadCrumbs;

    /**
     * Create a new component instance.
     */
    public function __construct(array $breadCrumbProps = [])
    {
        //
        $this->pageName    = $breadCrumbProps['page_name'] ?? '';
        $this->breadCrumbs = $breadCrumbProps['bread_crumbs'] ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
