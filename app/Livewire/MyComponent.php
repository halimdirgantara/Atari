<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyComponent extends Component
{
    protected $listeners = ['refreshPage'];

    public function refreshPage()
    {
        // Jika ingin hanya refresh bagian tertentu
        $this->emitSelf('refreshComponent');
    }

    public function render()
    {
        return view('livewire.my-component');
    }
}

