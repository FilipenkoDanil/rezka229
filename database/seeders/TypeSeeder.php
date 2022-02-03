<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [['Фильм', 'Фильмы'], ['Сериал', 'Сериалы'], ['Аниме', 'Аниме']];
        foreach ($types as $type) {
            DB::table('types')->insert([
                'video_type' => $type[0],
                'type_plural' => $type[1],
                'slug' => str_slug($type[1])
            ]);
        }
    }
}
