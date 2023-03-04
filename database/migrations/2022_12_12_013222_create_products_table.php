<?php

use App\Models\Business;
use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('business_id')->constrained();
            $table->foreignId('partner_id')->constrained();
            $table->string('production_code', 20);
            $table->string('name');
            $table->string('slug');
            $table->string('bpom');
            $table->text('description');
            $table->date('expired_date');
            $table->string('netto');
            $table->string('photo');
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
        Schema::dropIfExists('products');
    }
};
