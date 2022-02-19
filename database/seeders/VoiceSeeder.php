<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $voices = file_get_contents('voices.txt', true);

        $voices = explode(', ', $voices);

        foreach ($voices as $voice) {
            DB::table('voices')->insert([
                'voice' => $voice,
            ]);
        }
    }
}
