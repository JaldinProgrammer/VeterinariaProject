<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->string('nombre');
            $table->integer('gender');
            $table->string('photo')->nullable();
            $table->date('birthdate')->nullable();
            $table->date('deathdate')->nullable();
            $table->foreignId('breed_id')->constrained('breeds');
            $table->foreignId('user_id')->constrained('users');

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
        Schema::dropIfExists('pets');
    }
}
