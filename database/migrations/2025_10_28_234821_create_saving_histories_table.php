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
        Schema::create('saving_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('saving_id');
            $table->string('category')->comment('0=Withdraw,1=Deposit,2=Paid Withdrawal');
            $table->string('amount');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('saving_id')->references('id')->on('savings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_histories');
    }
};
