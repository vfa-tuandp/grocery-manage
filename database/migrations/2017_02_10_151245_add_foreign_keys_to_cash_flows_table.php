<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCashFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cash_flows', function (Blueprint $table) {

            $table->foreign('company_id', 'fk_cash_flow_company1')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cash_flows', function (Blueprint $table) {

            $table->dropForeign('fk_cash_flow_company1');
        });
    }
}
