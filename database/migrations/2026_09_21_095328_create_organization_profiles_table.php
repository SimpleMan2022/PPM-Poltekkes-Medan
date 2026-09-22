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
        Schema::create('organization_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('leader_name')->nullable();
            $table->string('leader_title')->nullable();
            $table->string('leader_position')->nullable();
            $table->string('leader_photo')->nullable();
            $table->text('welcome_message')->nullable();
            $table->string('organization_structure')->nullable();
            $table->text('duties_functions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_profiles');
    }
};
