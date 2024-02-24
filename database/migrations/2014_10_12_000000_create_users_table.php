<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create( 'users', function ( Blueprint $table )
        {
            $table->id();
            $table->string( 'name' )->nullable();
            $table->string( 'email' )->nullable();
            $table->string( 'phone_number' )->nullable();
            $table->string( 'password' )->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists( 'users' );
    }
};
