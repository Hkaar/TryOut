<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'org_img' => null,
            'org_name' => 'TryOut',
            'org_slug' => 'try-out',
            'org_slogan' => 'Try your best even if you fail!',
            'org_desc' => 'No description provided',
        ];

        foreach ($settings as $key => $value) {
            if (! Setting::StrictByName($key)->first()) {
                Setting::create([
                    'name' => $key,
                    'value' => $value,
                ]);
            }
        }
    }
}
