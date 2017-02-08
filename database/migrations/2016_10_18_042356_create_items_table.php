<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->string('name');
//            $table->integer('item_type_id')->unsigned();
            $table->string('unit', 100);
            $table->boolean('check_in_stock')->default(1);
            $table->integer('in_stock')->default(0)->unsigned();
            $table->integer('price_in_hint')->nullable();
            $table->integer('price_out_hint')->nullable();
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
        Schema::drop('items');
    }
}
