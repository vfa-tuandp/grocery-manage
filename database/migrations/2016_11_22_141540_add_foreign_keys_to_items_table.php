<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {

            $table->foreign('company_id', 'fk_item_company1')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('category_id', 'fk_item_category1')->references('id')->on('categories')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('item_type_id', 'fk_item_item_type1')->references('id')->on('m_item_type')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {

            $table->dropForeign('fk_item_company1');
            $table->dropForeign('fk_item_category1');
            $table->dropForeign('fk_item_item_type1');
        });
    }
}
