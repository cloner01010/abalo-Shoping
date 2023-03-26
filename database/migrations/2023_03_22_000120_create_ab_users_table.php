<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public string $table_name="ab_user";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primärschlüssel');
            $table->string('ab_name',80)->unique()->comment('Name');;
            $table->string('ab_password',200)->comment('Passwort');;
            $table->string('ab_mail',200)->unique()->comment('E-Mail-Adresse');;
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
