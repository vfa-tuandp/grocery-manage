<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPurchaseReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_receipts', function (Blueprint $table) {

            $table->foreign('company_id', 'fk_purchase_receipt_company1')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('supplier_id', 'fk_purchase_receipt_supplier1')->references('id')->on('suppliers')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_receipts', function (Blueprint $table) {

            $table->dropForeign('fk_purchase_receipt_company1');
            $table->dropForeign('fk_purchase_receipt_supplier1');
        });
    }
}
