<?php

use App\Models\User;
use App\Models\Partner;
use App\Models\Business;
use App\Models\Category;
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
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Business::class)->constrained();
            $table->foreignIdFor(Partner::class)->constrained();
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
