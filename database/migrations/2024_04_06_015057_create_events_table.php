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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('organizer');
            $table->text('address');
            $table->string('contact_no');
            $table->text('event_location');
            $table->string('event_purpose');
            $table->integer('estimated_attendees');

            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
