<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store')->nullable()->constrained('stores')->onDelete('cascade');
            $table->string('bank_name');
            $table->string('nomor_rekening')->unique();
            $table->string('atas_nama');
            $table->softDeletes();
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
        Schema::dropIfExists('store_banks');
    }
}
