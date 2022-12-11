<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('rooms_number')->unsigned();
            $table->tinyInteger('beds_number')->unsigned();
            $table->tinyInteger('bath_number')->unsigned();
            $table->smallInteger('meters')->unsigned();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('city');
            $table->string('image');
            $table->decimal('price');
            $table->boolean('visible')->default(true);
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
        Schema::dropIfExists('apartments');
    }
}
