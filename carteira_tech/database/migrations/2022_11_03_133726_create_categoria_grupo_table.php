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
        Schema::create('categoria_grupo', function (Blueprint $table) {
            $table->foreignId('categoria_id')->nullable()->constrained()->onUpdate('cascade')
                                                        ->onDelete('cascade');
            $table->foreignId('grupo_id')->nullable()->constrained()->onUpdate('cascade')
                                                        ->onDelete('cascade');
            $table->primary(['categoria_id', 'grupo_id']);
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
        Schema::dropIfExists('categoria_grupo');
    }
};
