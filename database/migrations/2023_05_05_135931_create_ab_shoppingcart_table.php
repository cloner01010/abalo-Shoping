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
        Schema::create('ab_shoppingcart', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->comment('Primärschlüssel');
            $table->bigInteger('ab_creator_id')->unsigned()->comment('Referenz auf einen Benutzer');
            $table->foreign('ab_creator_id')->references('id')->on('ab_user');
            $table->timestamp('ab_createdate')->comment('Zeitpunkt der Erstellung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_shoppingcart');
    }
};
