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
        Schema::create('requesteddocuments', function (Blueprint $table) {
            $table->id();
            $table->string('requested_document');
            $table->string('copies_ctc');
            $table->string('copies_orig');
            $table->string('status');
            $table->string('purpose');
            $table->string('birthplace');
            $table->string('student_number');
            $table->string('check_graduate');
            $table->string('last_term')->nullable();
            $table->string('last_school_year')->nullable();
            $table->string('check_correction');
            $table->string('orig_name')->nullable();
            $table->foreignId('userprofile_id')->constrained('userprofiles')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requesteddocuments');
    }
};
