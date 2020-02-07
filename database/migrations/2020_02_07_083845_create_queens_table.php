<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('race');
            $table->string('marking');
            $table->unsignedBigInteger('user_id');
            $table->boolean('archived')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('hives', function (Blueprint $table) {
            $table->unsignedBigInteger('queen_id')->nullable();

            $table->foreign('queen_id')->references('id')->on('queens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hives', function (Blueprint $table) {
            $table->dropForeign('queens_queen_id_foreign');
            $table->dropColumn('queen_id');
        });

        Schema::dropIfExists('queens');
    }
}
