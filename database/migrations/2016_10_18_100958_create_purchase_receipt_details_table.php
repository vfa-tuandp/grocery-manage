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
            $table->integer('purchase_receipt_id');
            $table->integer('item_id');
            $table->float('quantity');
            $table->float('price');
            $table->float('other_cost');
            $table->float('reduction');
            $table->text('note');
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
