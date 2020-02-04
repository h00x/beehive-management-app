<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hive_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('protected_type')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('hives', function (Blueprint $table) {
            $table->unsignedBigInteger('hive_type_id')->nullable();

            $table->foreign('hive_type_id')->references('id')->on('hive_types')->onDelete('cascade');
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
            $table->dropForeign('hives_hive_type_id_foreign');
            $table->dropColumn('hive_type_id');
        });
        Schema::dropIfExists('hive_types');
    }
}
