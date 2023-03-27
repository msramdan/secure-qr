<?php

use App\Models\QrCode;
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
        Schema::create('product_scanneds', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('qr_code_id')->constrained();
            $table->string('kota');
            $table->string('lat');
            $table->string('long');
            //add no wa
            $table->ipAddress('visitor');
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
        Schema::dropIfExists('product_scanneds');
    }
};
