<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class GenreSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $genres = file_get_contents('genres.txt', true);
            $genres = explode(',', $genres);

            foreach ($genres as $genre) {
                DB::table('genres')->insert([
                    'genre' => $genre,
                    'slug' => str_slug($genre)
                ]);
            }
        }
    }
