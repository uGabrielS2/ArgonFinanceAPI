<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_da_conta');
            $table->date('data');
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->decimal('agua', 10, 2)->nullable();
            $table->decimal('luz', 10, 2)->nullable();
            $table->decimal('gas', 10, 2)->nullable();
            $table->decimal('lazer', 10, 2)->nullable();
            $table->decimal('outros', 10, 2)->nullable();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
