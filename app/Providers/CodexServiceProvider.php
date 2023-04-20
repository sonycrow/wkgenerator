<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class CodexServiceProvider extends ServiceProvider
{
    protected static array $codex = [];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    { }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $codex = json_decode(Storage::disk('public')->get("codex.json"), true);
        self::$codex = $codex['unit'];
    }

    static public function getUnit(int $id): array
    {
        foreach (self::$codex as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }

        return array();
    }

    static public function getUnits(string $faction = null): array
    {
        if (!$faction) return self::$codex;

        $codex = array();
        foreach (self::$codex as $item) {
            if ($item['faction'] == $faction) {
                $codex[] = $item;
            }
        }

        return $codex;
    }

    static public function getArt(int $id): ?string
    {
        $unit = self::getUnit($id);
        $art = strtolower($unit['faction'] . "_" . str_replace(" ", "_", $unit['name']));

        if (file_exists(__DIR__ . "../../../resources/art/{$art}_{$id}.jpg")) {
            return "{$art}_{$id}";
        }
        if (file_exists(__DIR__ . "../../../resources/art/{$art}.jpg")) {
            return $art;
        }

        return null;
    }

}
