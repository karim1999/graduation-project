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
        Schema::create('box_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained(config('admin.database.users_table'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('box_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->double('price')->default(0);

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
        Schema::dropIfExists('box_prices');
    }
};
