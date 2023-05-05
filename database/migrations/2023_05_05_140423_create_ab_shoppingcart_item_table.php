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
        Schema::create('ab_shoppingcart_item', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->comment('Primärschlüssel');
            $table->bigInteger('ab_shoppingcart_id')->unsigned();
            $table->foreign('ab_shoppingcart_id')->references('id')->on('ab_shoppingcart')->cascadeOnDelete();
            $table->bigInteger('ab_article_id')->unsigned();
            $table->foreign('ab_article_id')->references('id')->on('ab_article');
            $table->timestamp('ab_createdate')->comment('Zeitpunkt der Erstellung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ab_shoppingcart_item');
    }
};
