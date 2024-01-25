<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->string('code',10);
            $table->string('status');
            $table->string('remark')->nullable(true);
            $table->date('reservation_date');
            $table->timestamp('confirmed_at')->nullable(true);
            $table->timestamp('served_at')->nullable(true);
            $table->unsignedBigInteger('customer_id')->nullable(false);
            $table->unsignedBigInteger('queue_type_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->on('customers')->references('id');
            $table->foreign('queue_type_id')->on('queue_types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
