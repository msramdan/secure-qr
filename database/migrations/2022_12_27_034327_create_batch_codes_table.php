<?php

use App\Models\Product;
use App\Models\QrCode;
use App\Models\RequestQrcode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('product_id')->constrained();
            $table->foreignId('qr_code_id')->constrained();
            $table->foreignId('request_qrcode_id')->constrained();
            $table->string('batch_code', 20);
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
        Schema::dropIfExists('batch_codes');
    }
};
