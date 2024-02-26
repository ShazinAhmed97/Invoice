<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entry', function (Blueprint $table) {
            $table->id('bId');
            $table->string('cust_name');
            $table->string('cust_email');
            $table->bigInteger('quantity');
            $table->bigInteger('amount');
            $table->bigInteger('tax_percentage');
            $table->float('tax_amount');
            $table->float('net_amount');
            $table->dateTime('date');
            $table->boolean('is_confirm')->default(0)
                ->comment('0-> dont have inovoice no.      1-> have invoice no.');
            $table->boolean('isAvail')->default(0)
                ->comment('0-> available      1-> not available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry');
    }
};
