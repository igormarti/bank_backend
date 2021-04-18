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
        Schema::create(/**
         * @param Blueprint $table
         */
            'transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('old_balance',12,2);
            $table->decimal('new_balance',12,2);
            $table->decimal('value',12,2);
            $table->char('status')->default(1);
            $table->integer('useraccount_id')->unsigned();
            $table->foreign('useraccount_id')->references('id')->on('useraccount')
                ->cascadeOnDelete();
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
