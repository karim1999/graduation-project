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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('from_address_id')->constrained('addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('to_address_id')->constrained('addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('vendor_id')->constrained(config('admin.database.users_table'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->double('total');
            $table->double('distance');
            $table->timestamp('pick_date')->nullable();
            $table->timestamp('ship_date')->nullable();
            $table->string('status')->default('PENDING');
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
        Schema::dropIfExists('orders');
    }
};
