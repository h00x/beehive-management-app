<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;

class CreateApiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apiaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('location');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('hives', function (Blueprint $table) {
            $table->unsignedBigInteger('apiary_id')->nullable();

            $table->foreign('apiary_id')->references('id')->on('apiaries')->onDelete('cascade');
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
            $table->dropForeign('hives_apiary_id_foreign');
            $table->dropColumn('apiary_id');
        });
        Schema::dropIfExists('apiaries');

        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public/images/apiaries');
    }
}
