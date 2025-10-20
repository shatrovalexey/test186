<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hunting_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('guide_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('participants_count');
            $table->timestamps();

            $table->index(['guide_id', 'date']);
            $table->index(['date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hunting_bookings');
    }
};