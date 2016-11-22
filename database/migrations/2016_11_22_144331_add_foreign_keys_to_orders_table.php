<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {

            $table->foreign('order_id', 'fk_order_detail_order1')->references('id')->on('orders')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('item_id', 'fk_order_detail_item1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {

            $table->dropForeign('fk_order_detail_order1');
            $table->dropForeign('fk_order_detail_item1');
        });
    }
}
