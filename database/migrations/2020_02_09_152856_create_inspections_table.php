<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->boolean('queen_seen')->default(false);
            $table->boolean('larval_seen')->default(false);
            $table->boolean('young_larval_seen')->default(false);
            $table->integer('pollen_arriving')->nullable();
            $table->integer('comb_building')->nullable();
            $table->text('notes')->nullable();
            $table->string('weather')->nullable();
            $table->integer('temperature')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hive_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hive_id')->references('id')->on('hives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspections');
    }
}
