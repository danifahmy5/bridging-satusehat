<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('identifier')->nullable()->default(null);
            $table->string('value_identifier')->nullable()->default(null);
            $table->string('ihs')->nullable()->default(null);
            $table->string('typecode')->nullable()->default(null);
            $table->string('typedisplay')->nullable()->default(null);
            $table->string('address_type')->nullable()->default(null);
            $table->string('address_use')->nullable()->default(null);
            $table->string('address_text')->nullable()->default(null);
            $table->string('address_line')->nullable()->default(null); 
            $table->string('pathOf')->nullable()->default(null); 
            $table->string('organitation_name')->nullable()->default(null); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi');
    }
};
