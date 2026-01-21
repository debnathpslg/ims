<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $colSpan = 'col-md-12',
        public string $type = 'text',
        public string $name = '',
        public string $labelCaption = '',
        public string $extraClass = '',
        public bool $required = false,
        public string $receivedData = ''
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.text-input');
    }
}
