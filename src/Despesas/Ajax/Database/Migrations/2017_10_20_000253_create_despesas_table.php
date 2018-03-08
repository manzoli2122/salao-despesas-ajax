<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('valor', 15, 8);

            $table->enum('tipo', [ 'salario' , 'adiantamento' , 'despesa'  ]);
            $table->string('descricao')->nullable();
            $table->unsignedInteger('funcionario_id')->nullable();
            $table->unsignedInteger('salario_id')->nullable();
            $table->unsignedInteger('produto_id')->nullable();

            $table->softDeletes();
            
            $table->timestamps();

            $table->foreign('funcionario_id')->references('id')->on('users');            
            $table->foreign('produto_id')->references('id')->on('produtos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
