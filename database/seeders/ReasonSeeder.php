<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class ReasonSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $reasons = ['Содержит матерные выражения', 'Содержит спойлер', 'Оскорбление других участников', 'Флуд', 'Другое'];

            foreach ($reasons as $reason) {
                DB::table('reasons')->insert([
                    'reason' => $reason
                ]);
            }
        }
    }
