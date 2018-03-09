<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Http\Controllers;

use Manzoli2122\Salao\Despesas\Ajax\Models\Despesa;
use Manzoli2122\Pacotes\Http\Controller\DataTable\Json\DataTableJsonController ;

class DespesaController extends DataTableJsonController
{


    protected $model;
    protected $name = "Despesas";
    protected $view = "despesasAjax::despesas";
    protected $route = "despesas.ajax";

    public function __construct( Despesa $despesa  ){
        $this->model = $despesa;       
        $this->middleware('auth');

        $this->middleware('permissao:despesas')->only([ 'index' , 'show'  ]) ;        
        $this->middleware('permissao:despesas-cadastrar')->only([ 'create' , 'store']);
        $this->middleware('permissao:despesas-editar')->only([ 'edit' , 'update']);
        $this->middleware('permissao:despesas-soft-delete')->only([ 'destroy' ]);
        
    }   



    public function destroy($id){
        try {
            
            if(!$model = $this->model->findModelJson($id) ){
                $msg = __('msg.erro_nao_encontrado', ['1' =>  $this->name ]);
                return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
            }  

            if($model->salario_id == '' and  $model->tipo <> 'salario'){
                $delete = $model->delete();                   
                $msg = __('msg.sucesso_excluido', ['1' =>  $this->name ]); 
            }
            else{
                $erro = true;
                $msg = __('msg.erro_salario_cadastrado');
            }

        } catch(\Illuminate\Database\QueryException $e) {
            $erro = true;
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' =>  $this->name  , '2' => 'Model']):
                __('msg.erro_bd');
        }
        return response()->json(['erro' => isset($erro), 'msg' => $msg , 'data' => null  ], 200);
    }




}
