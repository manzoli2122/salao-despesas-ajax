<?php

namespace Manzoli2122\Salao\Despesas\Ajax\Http\Controllers;

use Manzoli2122\Salao\Despesas\Ajax\Models\Despesa;
use Manzoli2122\Pacotes\Http\Controller\DataTable\Json\SoftDeleteJsonController ;

class DespesaSoftDeleteController extends SoftDeleteJsonController
{


    protected $model;
    protected $name = "Despesas";
    protected $view = "despesasAjax::despesas.apagados";
    protected $route = "despesas.ajax.apagados";



    public function __construct( Despesa $despesa  ){
        $this->model = $despesa;       
        $this->middleware('auth');

        $this->middleware('permissao:despesas')->only([ 'index' , 'show' ]) ;        
        $this->middleware('permissao:despesas-soft-delete')->only([ 'destroy' ]);

        
    }   




}
