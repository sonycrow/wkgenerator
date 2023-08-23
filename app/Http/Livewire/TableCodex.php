<?php

namespace App\Http\Livewire;

use App\Providers\CodexServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;
use Livewire\Livewire;

class TableCodex extends Component
{
    // Propiedades de Datatable
    public array $props = [
        "allowSelection" => false
    ];

    public array $headers = array();
    public array $elements = array();

    /**
     * Constructor del componente
     */
    public function mount()
    {
        $this->loadHeaders();
        $this->loadElements();
    }

    /**
     * Vista del componente
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.table-codex');
    }

    /**
     * Genera las cabeceras de la tabla
     */
    private function loadHeaders(): void
    {
        $this->headers = array(
            array("key" => "id",       "value" => "ID"),
            array("key" => "sticker",  "value" => "Sticker"),
            array("key" => "name",     "value" => "Name"),
            array("key" => "te_icon",  "value" => "Type"),
            array("key" => "atk",      "value" => "Attack"),
            array("key" => "move",     "value" => "Move"),
            array("key" => "cost",     "value" => "Cost"),
            array("key" => "steps",    "value" => "Steps"),
            array("key" => "universe", "value" => "Universe"),
            array("key" => "faction",  "value" => "Faction"),
            array("key" => "terrain",  "value" => "Terrain")
        );
    }

    /**
     * Obtiene los elementos de la tabla y rellena las filas.
     */
    private function loadElements(): void
    {
        // Init
        $this->elements = array();

        // Unidades
        foreach (CodexServiceProvider::getUnits() as $item)
        {
            // TODO Para montar un componente Livewire en el controlador de otro componente, usamos Livewire::mount
            // Livewire::mount('unit', ['id' => $item['id']])->html(),

            $img = "resources/units/{$item['universe']}/" . strtolower($item['faction'] . "_" . str_replace(" ", "_", $item['name'])) . "_{$item['id']}.png";
            $unit = array(
                "id" => $item['id'],
                "sticker" => file_exists(__DIR__ . "../../../../{$img}") ? "img:" . Vite::asset($img) . ",w:32" : null,
                "name" => ucwords($item['name']),
                "te_icon" => !empty($item['terrain']) ? "img:" . Vite::asset("resources/img/mov-{$item['terrain']}.png") . ",w:24" : null,
                "atk" => strtoupper($item['atk']),
                "move" => $item['move'] ?? null,
                "cost" => $item['cost'],
                "steps" => $item['steps'],
                "universe" => $item['universe'] == 'wk' ? "Wizard Kings" : "Warhammer 40K",
                "faction" => ucfirst($item['faction']),
                "terrain" => !empty($item['terrain']) ? ucfirst($item['terrain']) : null
            );

            // Genera el elemento final
            $this->elements[] = $unit;
        }
    }

}
