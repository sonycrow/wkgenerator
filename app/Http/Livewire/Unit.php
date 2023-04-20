<?php

namespace App\Http\Livewire;

use App\Providers\CodexServiceProvider;
use Livewire\Component;

class Unit extends Component
{
    public array $unit;
    public string $class;

    public bool $tts;
    public bool $images;
    public bool $download;

    /**
     * Constructor del componente
     */
    public function mount(string $id, ?bool $tts = false, ?bool $images = false, ?bool $download = false)
    {
        // Vars
        $this->tts      = $tts;
        $this->images   = $images;
        $this->download = $download;
        $this->class    = $this->tts ? "unittts" : "unit";

        // Datos de la unidad
        $this->unit = CodexServiceProvider::getUnit($id);

        // Miramos el arte
        $art = strtolower($this->unit['faction'] . "_" . str_replace(" ", "_", $this->unit['name']));

        // Parametros extra
        $this->unit['move']    = !isset($this->unit['move']) ? "" : $this->unit['move'];
        $this->unit['terrain'] = $this->unit['terrain'] ?? "";
        $this->unit['art']     = CodexServiceProvider::getArt($this->unit['id']);
        $this->unit['nameid']  = $art . "_" . $this->unit['id'];
    }

    /**
     * Vista del componente
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.unit');
    }

}
