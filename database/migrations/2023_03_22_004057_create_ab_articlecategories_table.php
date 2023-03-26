<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table_name='ab_articlecategory';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primärschlüssel');
            $table->string('ab_name',100)->unique()->comment('Name');
            $table->string('ab_description',1000)->comment('Beschreibung')->nullable();
            $table->bigInteger('ab_parent')->nullable()->unsigned()->comment('Referenz auf die mögliche Elternkategorie.
                                                                                              Artikelkategorien sind hierarchisch organisiert. Eine Kategorie
                                                                                              kann beliebig viele Kind Kategorien haben. Eine Kategorie kann
                                                                                              nur eine Elternkategorie besitzen.
                                                                                              NULL, falls es keine Elternkategorie gibt und es sich um eine
                                                                                              Wurzelkategorie handelt.');



            $table->timestamps();
        });
        Schema::table($this->table_name, function (Blueprint $table)
        {
            $table->foreign('ab_parent')->references('id')->on($this->table_name)->cascadeOnDelete()->cascadeOnUpdate();
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
