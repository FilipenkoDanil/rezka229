<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class YearSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            for ($i = 1980; $i <= 2022; $i++) {
                DB::table('years')->insert(
                    [
                        'year' => $i
                    ]
                );
            }
        }
    }
