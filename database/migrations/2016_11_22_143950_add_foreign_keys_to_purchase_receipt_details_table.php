<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPurchaseReceiptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_receipt_details', function (Blueprint $table) {

            $table->foreign('purchase_receipt_id', 'fk_purchase_receipt_detail_purchase_receipt1')->references('id')->on('purchase_receipts')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('item_id', 'fk_purchase_receipt_detail_item1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_receipt_details', function (Blueprint $table) {

            $table->dropForeign('fk_purchase_receipt_detail_purchase_receipt1');
            $table->dropForeign('fk_purchase_receipt_detail_item1');
        });
    }
}
