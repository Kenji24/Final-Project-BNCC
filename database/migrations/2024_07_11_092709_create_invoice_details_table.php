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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('invoice_headers_id');
            $table->unsignedBigInteger('toy_id');
            $table->integer('quantity');
            $table->integer('subTotal');
            $table->timestamps();

            $table->foreign('invoice_headers_id')->references('id')->on('invoice_headers')->onDelete('cascade');
            $table->foreign('toy_id')->references('id')->on('toys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_detail');
    }
};
