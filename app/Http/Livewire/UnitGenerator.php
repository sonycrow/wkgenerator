<?php

namespace App\Http\Livewire;

use App\Providers\CodexServiceProvider;
use Livewire\Component;

class UnitGenerator extends Component
{
    public $faction = "-";

    public $tts = false;
    public $images = false;
    public $download = false;

    /**
     * Vista del componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.unit-generator');
    }

}
