<?php

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
        Schema::create('setting_webs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('nama_website');
            $table->string('kode_website')->nullable();
            $table->string('logo_dark');
            $table->string('logo_light');
            $table->string('telpon');
            $table->string('email');
            $table->text('alamat');
            $table->text('deskripsi');
            $table->boolean('is_aktif');
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
        Schema::dropIfExists('setting_webs');
    }
};
