<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru');
            $table->string('title_en');
            $table->boolean('is_end')->default(1);
            $table->text('about');
            $table->date('date');
            $table->foreignId('year_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->integer('views')->default(0);
            $table->string('slug')->unique();
            $table->string('poster');
            $table->integer('runtime_min');

            $table->string('imdb_id')->unique();
            $table->string('imdb_rating');
            $table->integer('imdb_votes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
