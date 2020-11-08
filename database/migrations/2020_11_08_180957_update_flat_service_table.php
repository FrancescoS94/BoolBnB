<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFlatServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flat_service', function (Blueprint $table) {
            $table->foreignId('flat_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flat_service', function (Blueprint $table) {
                $table->dropForeign(['flat_id']);
                $table->dropColumn('flat_id');

                $table->dropForeign(['service_id']);
                $table->dropColumn('service_id');

                $table->dropColumn('id');
        });
    }
}
