<?php

use App\Models\QrCode;
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
        Schema::create('product_reports', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('qr_code_id')->constrained();
            $table->string('fullname');
            $table->bigInteger('phone_number');
            $table->text('kronologi');
            $table->string('file');
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
        Schema::dropIfExists('product_reports');
    }
};
