<?php

use App\Models\QrCode;
use App\Models\Partner;
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
        Schema::create('loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('partner_id')->constrained()->cascadeOnDelete();
            $table->foreignId('qr_code_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('deskription');
            $table->date('start_program');
            $table->date('end_program');
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
        Schema::dropIfExists('loyalty_programs');
    }
};
