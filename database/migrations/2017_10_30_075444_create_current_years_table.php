<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_years', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year', false, true)->unique()->nullable();
            $table->integer('assaults', false, true)->nullable()->default(0);
            $table->integer('murders', false, true)->nullable()->default(0);
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
        Schema::dropIfExists('current_years');
    }
}
