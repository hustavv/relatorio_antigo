<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDadosnotasimportadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dadosnotasimportadas', function (Blueprint $table) {
            $table->id('id_relatorio');
            $table->string('nome_aluno', 200);
            $table->string('cpf_aluno', 15);
            $table->string('matricula_aluno', 30);
            $table->string('codigo_curso', 50);
            $table->string('codigo_disciplina', );
            $table->string('nome_curso', 100);
            $table->string('nome_disciplina', 100);
            $table->string('polo', 30);
            $table->float('ad1')->nullable();
            $table->float('ap1')->nullable();
            $table->float('ad2')->nullable();
            $table->float('ap2')->nullable();
            $table->float('ap3')->nullable();
            $table->date('data_geracao_arquivo');
            $table->integer('responsavel_id');
            $table->integer('idsemestre');
            
            $table->date('data_importacao');

            $table->foreign('responsavel_id')->references('idusuario')->on('usuario');
            $table->foreign('idsemestre')->references('idsemestre')->on('semestre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dadosnotasimportadas');
    }
}
