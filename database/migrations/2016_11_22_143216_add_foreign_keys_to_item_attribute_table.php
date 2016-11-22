<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToItemAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_attribute', function (Blueprint $table) {

            $table->foreign('item_id', 'fk_item_item_attribute1')->references('id')->on('items')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_attribute', function (Blueprint $table) {

            $table->dropForeign('fk_item_item_attribute1');
        });
    }
}