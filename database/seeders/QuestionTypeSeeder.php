<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['multiple_choice', 'essay'];

        foreach ($types as $type) {
            if (! QuestionType::StrictByName($type)->first()) {
                QuestionType::create([
                    'name' => $type,
                ]);
            }
        }
    }
}
