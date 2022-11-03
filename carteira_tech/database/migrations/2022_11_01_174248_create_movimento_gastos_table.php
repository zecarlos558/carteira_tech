<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento_gastos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->double('valor');
            $table->dateTime('data');
            $table->text('descricao')->nullable($value = true);
            $table->enum('tipo', ['retirada']);
            $table->foreignId('conta_id')->constrained();
            $table->foreignId('categoria_id')->constrained();
            $table->foreignId('user_id_create')->constrained();
            $table->foreignId('user_id_update')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimento_gastos');
    }
};
