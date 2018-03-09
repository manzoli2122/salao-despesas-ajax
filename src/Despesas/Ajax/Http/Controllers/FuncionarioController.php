<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DataTables;

use Manzoli2122\Pacotes\Http\Controller\DataTable\Json\DataTableJsonController ;

use Manzoli2122\Salao\Despesas\Ajax\Models\Adiantamento;
use Manzoli2122\Salao\Despesas\Ajax\Models\Funcionario;
use Manzoli2122\Salao\Despesas\Ajax\Models\Salario;

use ChannelLog as Log;

class FuncionarioController extends DataTableJsonController{


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


/*
    public function index(){

        $models = $this->model::ativo()->get();
        return view("{$this->view}.index", compact('models', 'title'));

    }

*/

/*
    
    public function show($id){

        $title = "Visualizando {$this->name}";
        $model = $this->model->ativo()->find($id);
        if($model)
            return view("{$this->view}.show", compact('model'));
        return redirect()->route("{$this->route}.index");

    }

*/




    public function storeAdiantamento(Request $request, $id)
    {         
        $dataForm = $request->all();              
        $insert = $this->adiantamento->create($dataForm); 

        $msg =  "CREATEs - " . 'Adiantamento Cadastrado(a) com sucesso !! ' . $insert . ' responsavel: ' . session('users') ;
        Log::write( $this->logCannel , $msg  ); 

        return redirect()->route("{$this->route}.show", ['id' => $id]);   
    }





    
    public function storeSalario($id)
    {        
        $funcionario = Funcionario::find($id);
        if($funcionario->valorSalarioLiquido()<=0){
            return  redirect()->route("funcionarios.show",['id' => $id]);
        }

        //$valor = 0.0;
        
        $salario = new Salario();
        $salario->funcionario()->associate($funcionario);
        $salario->valor =  $funcionario->valorSalarioLiquido() ;
        $salario->tipo = 'salario';
        $salario->descricao = $funcionario->name;
        $salario->save();

        foreach(   $funcionario->AtendimentosSemSalario() as $servico){
            $servico->salario()->associate($salario);
            $servico->save();
            //$valor = $valor + (($servico->servico->valor - $servico->desconto) * ($servico->servico->porcentagem_funcionario / 100 )) ;
        }



        foreach(  $funcionario->AdiantamentosSemSalario() as $adiantamento){
            $adiantamento->salario()->associate($salario);
            $adiantamento->save();
            //$valor = $valor - $adiantamento->valor  ;
        }



        $msg =  "CREATEs - " . 'Salario Cadastrado(a) com sucesso !! ' . $salario . ' responsavel: ' . session('users') ;
        Log::write( $this->logCannel , $msg  ); 
       // $salario->valor =  $valor ;       
       // $salario->save();

       return redirect()->route("{$this->route}.show", ['id' => $id]);          
       
        
    }
    


}
