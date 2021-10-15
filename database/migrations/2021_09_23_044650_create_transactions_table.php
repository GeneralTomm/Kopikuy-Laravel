<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->bigInteger('userId')->unsigned();
            $table->foreign('userId')->references('id')->on('users');
            $table->double('grandtotal');
            $table->enum('metodePembayaran',['cash','virtual']);
            $table->enum('pengambilan',['kasir','drive']);
            $table->text('bukti');
            $table->string('kodetransaksi');
            $table->string('token');
            $table->enum('status',['ok','no']);
            $table->string('penerima');
            $table->enum('recap',['true','false']);
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
        Schema::dropIfExists('transactions');
    }
}
