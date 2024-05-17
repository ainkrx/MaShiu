<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
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
        //
    }
};
