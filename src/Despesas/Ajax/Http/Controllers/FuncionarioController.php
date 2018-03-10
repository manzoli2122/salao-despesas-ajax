<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DataTables;
use View;
use Manzoli2122\Pacotes\Http\Controller\DataTable\Json\DataTableJsonController ;

use Manzoli2122\Salao\Despesas\Ajax\Models\Adiantamento;
use Manzoli2122\Salao\Despesas\Ajax\Models\Funcionario;
use Manzoli2122\Salao\Despesas\Ajax\Models\Salario;

use ChannelLog as Log;

class FuncionarioController extends DataTableJsonController  {


    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected $model;
    protected $adiantamento;
    protected $name = "Funcioanrios";
    protected $view = "despesasAjax::funcionarios";
    protected $route = "funcionarios.ajax";
    protected $logCannel;




    public function __construct(Funcionario $funcionario, Adiantamento $adiantamento){
        $this->model = $funcionario; 
        $this->logCannel = 'despesas';
        $this->adiantamento = $adiantamento;        
        $this->middleware('auth');
    }




    /**
    * Processa a requisição AJAX do DataTable na página de listagem.
    * Mais informações em: http://datatables.yajrabox.com
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function getDatatable(){
        $models = $this->model->getDatatable();
        return Datatables::of($models)
            ->addColumn('action', function($linha) {
                return  '<button data-id="'.$linha->id.'" type="button" class="btn btn-primary btn-xs btn-datatable" btn-show    title="Visualizar" style="margin-left: 10px;"> <i class="fa fa-search"></i> </button>' ;
            })->make(true);
    }










    public function storeAdiantamento(Request $request, $id)
    {         
        $dataForm = $request->all();  

        $insert = $this->adiantamento->create($dataForm); 

        $msg =  "CREATEs - " . 'Adiantamento Cadastrado(a) com sucesso !! ' . $insert . ' responsavel: ' . session('users') ;
        Log::write( $this->logCannel , $msg  ); 

        return response()->json(['erro' => false , 'msg' =>'' , 'data' => null  ], 200);   
    }








    public function adiantamento($id){    
        try {            
            if(!$model = $this->model->findModelJson($id) ){
                $msg = __('msg.erro_nao_encontrado', ['1' =>  $this->name ]);
                return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
            } 
            
            $html = (string) View::make("{$this->view}.adiantamento", compact("model"));            
            $html =  preg_replace( '/\r/' , '', $html)  ; 
            $html =  preg_replace( '/\n/' , '', $html)  ;
            $html =  preg_replace( '/\t/' , '', $html)  ;  
            $html =  preg_replace( '/(>)(\s+)(<)/' , '\1\3', $html)  ; 
            return response()->json(['erro' => false , 'msg' =>'' , 'data' => $html   ], 200);  
           
        } catch(\Illuminate\Database\QueryException $e) {
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' =>  $this->name  , '2' => 'Model']):
                __('msg.erro_bd');
            return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
        }
    }









    
    public function storeSalario($id)
    {      
        
        try {    

            if( !$funcionario = Funcionario::find($id) ) {
                $msg = __('msg.erro_nao_encontrado', ['1' =>  $this->name ]);
                return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
            } 

            if($funcionario->valorSalarioLiquido()<=0){
                return response()->json(['erro' => true , 'msg' => 'Funcionario com mais adiantamento do que a receber.' , 'data' => null ], 200);
            }

            $salario = new Salario();
            $salario->funcionario()->associate($funcionario);
            $salario->valor =  $funcionario->valorSalarioLiquido() ;
            $salario->tipo = 'salario';
            $salario->descricao = $funcionario->name;
            $salario->save();
    
            foreach(   $funcionario->AtendimentosSemSalario() as $servico){
                $servico->salario()->associate($salario);
                $servico->save();
            }


            foreach(  $funcionario->AdiantamentosSemSalario() as $adiantamento){
                $adiantamento->salario()->associate($salario);
                $adiantamento->save();
            }

            $msg =  "CREATEs - " . 'Salario Cadastrado(a) com sucesso !! ' . $salario . ' responsavel: ' . session('users') ;
            $model = $funcionario ;
            $html = (string) View::make("{$this->view}.show", compact("model"));            
            $html =  preg_replace( '/\r/' , '', $html)  ; 
            $html =  preg_replace( '/\n/' , '', $html)  ;
            $html =  preg_replace( '/\t/' , '', $html)  ;  
            $html =  preg_replace( '/(>)(\s+)(<)/' , '\1\3', $html)  ; 

            return response()->json(['erro' => false , 'msg' =>  $msg  , 'data' => $html   ], 200);  
     
        } catch(\Illuminate\Database\QueryException $e) {
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' =>  $this->name  , '2' => 'Model']):
                __('msg.erro_bd');
            return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
        }

        
    }
    



    public function salario($id){    
        try {            
            if(!$model = $this->model->findModelJson($id) ){
                $msg = __('msg.erro_nao_encontrado', ['1' =>  $this->name ]);
                return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
            } 
            
            $html = (string) View::make("{$this->view}.salario", compact("model"));            
            $html =  preg_replace( '/\r/' , '', $html)  ; 
            $html =  preg_replace( '/\n/' , '', $html)  ;
            $html =  preg_replace( '/\t/' , '', $html)  ;  
            $html =  preg_replace( '/(>)(\s+)(<)/' , '\1\3', $html)  ; 
            return response()->json(['erro' => false , 'msg' =>'' , 'data' => $html   ], 200);  
           
        } catch(\Illuminate\Database\QueryException $e) {
            $msg = $e->errorInfo[1] == ErrosSQL::DELETE_OR_UPDATE_A_PARENT_ROW ? 
                __('msg.erro_exclusao_fk', ['1' =>  $this->name  , '2' => 'Model']):
                __('msg.erro_bd');
            return response()->json(['erro' => true , 'msg' => $msg , 'data' => null ], 200);
        }
    }



}
