<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            $settings = $this->extractNested(Setting::all(['name', 'value'])->toArray());
        } catch (\Throwable $th) {
            $settings = [];
        }

        View::share('settings', $settings);
    }

    /**
     * Extract the nested items of an array
     * 
     * @param array<array<string, string>> $items
     * @return array<int|string, string|false>
     */
    private function extractNested(array $items): array
    {
        $result = [];

        foreach ($items as $nested) {
            $result[reset($nested)] = end($nested);
        }

        return $result;
    }
}
