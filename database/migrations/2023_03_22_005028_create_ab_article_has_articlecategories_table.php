<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public string $table_name='ab_article_has_articlecategory';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primärschlüssel');
            $table->bigInteger('ab_articlecategory_id')->unsigned()->comment('Referenz auf eine Artikelkategorie');
            $table->bigInteger('ab_article_id')->unsigned()->comment('Referenz auf einen Artikel');
            $table->unique(['ab_articlecategory_id', 'ab_article_id']);
            $table->foreign('ab_articlecategory_id')->references('id')->on('ab_articlecategory');
            $table->foreign('ab_article_id')->references('id')->on('ab_article');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table_name);
    }


};
