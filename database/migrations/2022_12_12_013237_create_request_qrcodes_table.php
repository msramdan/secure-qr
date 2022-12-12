<?php

use App\Models\User;
use App\Models\Product;
use App\Models\TypeQrcode;
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
        Schema::create('request_qrcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(TypeQrcode::class)->constrained();
            $table->string('code', 100);
            $table->dateTime('tanggal_request');
            $table->integer('qty');
            $table->integer('sn_length');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('amount_price');
            $table->enum('status', ['Waiting Payment', 'Pending Payment', 'Proses Cetak QR', 'Dalam Pengiriman']);
            $table->string('jasa_kirim')->nullable();
            $table->string('no_resi')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->dateTime('tgl_upload_bukti_bayar')->nullable();
            $table->string('is_generate')->nullable();
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
        Schema::dropIfExists('request_qrcodes');
    }
};
