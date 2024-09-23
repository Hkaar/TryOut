<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['in progress', 'not sure', 'answered'];

        foreach ($statuses as $status) {
            if (! Status::StrictByName($status)) {
                Status::create([
                    'name' => $status,
                ]);
            }
        }
    }
}
