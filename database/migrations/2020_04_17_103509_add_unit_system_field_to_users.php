<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitSystemFieldToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('uses_metric')->default(true);
        });

        Schema::table('harvests', function (Blueprint $table) {
            $table->decimal('weight', 20, 6)->change();
        });

        Schema::table('inspections', function (Blueprint $table) {
            $table->decimal('temperature', 20, 6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uses_metric');
        });

        Schema::table('harvests', function (Blueprint $table) {
            $table->integer('weight')->change();
        });

        Schema::table('inspections', function (Blueprint $table) {
            $table->integer('temperature')->change();
        });
    }
}
