<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Models;

use Illuminate\Database\Eloquent\Model; 
use Manzoli2122\Pacotes\Contracts\Models\DataTableJson;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Config;

class Despesa extends Model  implements DataTableJson
{
    
    use SoftDeletes;


    public function newInstance($attributes = [], $exists = false){
        $model = parent::newInstance($attributes, $exists);    
        $model->setTable($this->getTable());    
        return $model;
    }



    public function getTable() {
        return   Config::get('despesas.despesas_table' , 'despesas') ;
    }
    
    

    public function destinacao(){
        if( $this->tipo === 'adiantamento' or  $this->tipo === 'salario'  ){
            return $this->funcionario->name   ;
        }
        return   $this->categoria ;
    }
    


    protected $fillable = [
            'tipo', 'valor', 'descricao' , 'categoria' , 'salario_id'
    ];



    public function funcionario(){
        return $this->belongsTo('Manzoli2122\Salao\Despesas\Models\Funcionario', 'funcionario_id');
    }




    public function rules($id = ''){
        return [
            'descricao' => 'required|min:3|max:150',
            'valor' => 'required|numeric|min:0',    
            'categoria' => 'required',
        ];
    }






    public function findModelJson($id){
        return $this->find($id);
    }



    
    public function findModelSoftDeleteJson($id){
        return $this->onlyTrashed()->find($id);
    }



    
    public function getDatatable(){
        return $this->select(['id', 'tipo', 'categoria', 'descricao',  DB::raw(  "DATE_FORMAT( created_at, '%Y-%m-%d')  as created_at " ) ,   DB::raw("concat( 'R$' , round( valor, 2 )) as valor")   ])->orderBy('created_at', 'desc');        
    }
    





    public function getDatatableApagados(){
        return $this->onlyTrashed()->select(['id', 'tipo', 'categoria', 'descricao',   DB::raw( " created_at as created_at " ) , DB::raw("concat( 'R$' , round( valor, 2 )) as valor") ]);        
    }
   
    
}
