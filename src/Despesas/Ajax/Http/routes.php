<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'gastos/ajax', 'middleware' => 'auth' ], function(){


        // DESPESAS
        Route::post('despesas/getDatatable', 'DespesaController@getDatatable')->name('despesas.ajax.getDatatable');        
        Route::resource('despesas', 'DespesaController' , ['names' => [
            'create' => 'despesas.ajax.create' ,
            'index' => 'despesas.ajax.index' ,
            'edit' => 'despesas.ajax.edit' ,
            'update' => 'despesas.ajax.update' ,
            'store' => 'despesas.ajax.store' ,
            'show' => 'despesas.ajax.show' ,
            'destroy' => 'despesas.ajax.destroy' ,
        ]]); 





        //  FUNCIONARIOS
        Route::post('funcionarios/getDatatable', 'FuncionarioController@getDatatable')->name('funcionarios.ajax.getDatatable');
        Route::get('funcionarios', 'FuncionarioController@index')->name('funcionarios.ajax.index');
        Route::get('funcionarios/{id}', 'FuncionarioController@show')->name('funcionarios.ajax.show');

        Route::post('funcionario/salarios/cadastrar/{id}', 'FuncionarioController@storeSalario')->name('salario.ajax.cadastrar');
        Route::post('funcionarios/salario/{id}', 'FuncionarioController@salario')->name('funcionarios.ajax.salario');

        Route::post('funcionarios/adiantamentos/cadastrar/{id}', 'FuncionarioController@storeAdiantamento')->name('adiantamento.ajax.cadastrar');
        Route::post('funcionarios/adiantamentos/{id}', 'FuncionarioController@adiantamento')->name('funcionarios.ajax.adiantamento');
    

    });