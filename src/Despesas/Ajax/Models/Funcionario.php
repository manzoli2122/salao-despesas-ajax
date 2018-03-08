<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Funcionario extends Model 
{
    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);    
        $model->setTable($this->getTable());    
        return $model;
    }

    public function getTable()
    {
        return  Config::get('despesas.funcionario_table' , 'users') ; 
    }



    protected $fillable = [
        'name', 'email',   'apelido' , 'nascimento' , 'celular' , 'ativo'
    ];

   


    protected $dates = [
        'created_at',
        'updated_at',
        'nascimento'
    ];



    public function scopeAtivo($query)
    {
        return $query->where('ativo', 1)->whereIn('id', function($query2) { 
                                                        $query2->select("perfils_users.user_id");
                                                        $query2->from("perfils_users");
                                                        $query2->whereIn("perfils_users.perfil_id" , function($query3) {
                                                            $query3->select("perfils.id");
                                                            $query3->from("perfils");
                                                            $query3->where('nome' , 'Funcionario');
                                                        } );                                                            
                                                    });
    }

    

    public function index($totalPage)
    {
        return $this->ativo()->orderBy('name', 'asc')->paginate($totalPage);        
    }



    public function salarios()
    {        
        return $this->hasMany('Manzoli2122\Salao\Despesas\Models\Salario', 'funcionario_id');
    }


    public function adiantamentos()
    {        
        return $this->hasMany('Manzoli2122\Salao\Despesas\Models\Adiantamento', 'funcionario_id');
    }



    
    public static function funcionarios(){       
        return  Funcionario::whereIn('id', function($query2) { //} use ($user){
                        $query2->select("perfils_users.user_id");
                        $query2->from("perfils_users");
                        $query2->whereIn("perfils_users.perfil_id" , function($query3) {
                            $query3->select("perfils.id");
                            $query3->from("perfils");
                            $query3->where('nome' , 'Funcionario');
                        } );                                                            
            })->get();         
    }


    public function Atendimentos()
    {
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario', 'funcionario_id');
       
    }



    public function AtendimentosSemSalario()
    {
        return $this->hasMany('Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario', 'funcionario_id')->whereNull('salario_id')->get();
        //return $this->whereNull('salario_id')->where('funcionario_id' , $funcionarioId)->get();
    }


    public function valorBrutoSalario()
    {
        $valor = 0.0 ;
        foreach( $this->AtendimentosSemSalario() as $servico){
            $valor =  $valor +  $servico->valorFuncioanrio() ;
        }      
        
        return $valor;
    }




    public function valorAdiantamento()
    {
        $valor = 0.0 ;
        foreach( $this->AdiantamentosSemSalario() as $adiantamento){
            $valor =  $valor +  $adiantamento->valor ;
        }      
        
        return $valor;
    }



    public function AdiantamentosSemSalario()
    {
        return $this->hasMany('Manzoli2122\Salao\Despesas\Models\Adiantamento', 'funcionario_id')->whereNull('salario_id')->orderBy('created_at', 'asc')->get();
    }



    public function valorSalarioLiquido()
    {
        $valor = $this->valorBrutoSalario()  - $this->valorAdiantamento();  
        
        return $valor;
    }


    
}
