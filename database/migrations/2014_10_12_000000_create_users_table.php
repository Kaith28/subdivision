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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('company_name')->nullable();
            $table->string('subdivision')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('address')->nullable();
            $table->string('relatives')->nullable();
            $table->string('position')->nullable();
            $table->string('photo')->nullable();
            $table->enum('role', ['owner', 'admin', 'guard', 'resident', 'driver']);
            $table->enum('status', ['in', 'out'])->default('in');
            $table->boolean('is_deleted')->default(false);
            /* $table->enum('status', ['in', 'out'])->default(function () {
            return $user->resident ? 'in' : 'out'}; */
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
