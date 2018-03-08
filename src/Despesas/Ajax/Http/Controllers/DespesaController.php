<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Http\Controllers;

use Manzoli2122\Salao\Despesas\Ajax\Models\Despesa;
use Illuminate\Http\Request;
use Manzoli2122\Salao\Cadastro\Ajax\Http\Controllers\Padroes\SoftDeleteController ;
use ChannelLog as Log;

class DespesaController extends SoftDeleteController
{

    

    protected $model;
    protected $name = "Despesas";
    protected $view = "despesas::despesas";
    protected $view_apagados = "despesas::despesas.apagados";
    protected $route = "despesas";

    //protected $logCannel = 'audit' ;


    public function __construct(Despesa $despesa  ){
        $this->model = $despesa;       
        $this->middleware('auth');

        $this->logCannel = 'despesas';

        $this->middleware('permissao:despesas')->only([ 'index' , 'show'  ]) ;        
        $this->middleware('permissao:despesas-cadastrar')->only([ 'create' , 'store']);
        $this->middleware('permissao:despesas-editar')->only([ 'edit' , 'update']);
        $this->middleware('permissao:despesas-soft-delete')->only([ 'destroySoft' ]);
        $this->middleware('permissao:despesas-restore')->only([ 'restore' ]);
        $this->middleware('permissao:despesas-admin-permanete-delete')->only([ 'destroy' ]);
        $this->middleware('permissao:despesas-apagados')->only([ 'indexApagados' , 'showApagado' ]) ;
                   


    }
    

    // NÃO EXCLUI SALARIO OU ADIANTAMENTO JA CALCULADO NO SALARIO.
    public function destroySoft($id)
    {
        try {            
            $model = $this->model->find($id);
            if($model->salario_id == '' and  $model->tipo <> 'salario'){
                $delete = $model->delete();                   
                $msg = __('msg.sucesso_excluido', ['1' => $this->name ]);
                $msg2 =  "DELETEs - " . $this->name . ' apagado(a) com sucesso !! ' . $model . ' responsavel: ' . session('users') ;
                Log::write( $this->logCannel , $msg2  );  
            }
            else{
                $erro = true;
                $msg = __('msg.erro_salario_cadastrado');
            }
            
        } 
        catch(\Illuminate\Database\QueryException $e) 
        {
            $erro = true;
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' => $this->name , '2' => 'Model']):
                __('msg.erro_bd');
        }
        return response()->json(['erro' => isset($erro), 'msg' => $msg], 200);

    }





}
