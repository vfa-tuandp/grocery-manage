<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReceiptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_receipt_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_receipt_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('reduction_on_item')->nullable();
            $table->integer('other_cost_on_item')->nullable();
            $table->text('note_on_item')->nullable();
            $table->integer('sum');
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
        Schema::drop('purchase_receipt_details');
    }
}
