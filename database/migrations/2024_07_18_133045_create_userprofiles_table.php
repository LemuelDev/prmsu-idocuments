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
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('extensionname')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('age');
            $table->string('sex');
            $table->string('course');
            $table->string('address');
            $table->string('birthday');
            $table->string('year');
            $table->string('phone_number');
            $table->string('avatar')->nullable();
            $table->boolean('dark_mode')->default(0);
            $table->string('messenger_color')->nullable();
            $table->string('user_type')->default('student');
            $table->string('user_status')->default('enable');
            $table->string('isPending')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userprofiles');
    }
};
