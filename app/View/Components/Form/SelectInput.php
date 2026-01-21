<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $colSpan = 'col-md-12',
        public string $labelCaption = '',
        public string $name = '',
        public array $options = [],
        public bool $required = false,
        public mixed $selected = null,
        public string $selectedData = ''
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select-input');
    }
}
