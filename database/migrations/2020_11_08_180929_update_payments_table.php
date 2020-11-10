<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('flat_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
                $table->dropForeign(['flat_id']);
                $table->dropColumn('flat_id');

                $table->dropForeign(['rate_id']);
                $table->dropColumn('rate_id');
        });
    }
}
