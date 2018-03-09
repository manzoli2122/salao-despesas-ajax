<section class="content-header">
    <h1>
        <span id="div-titulo-pagina">{{$model->tipo}}</span>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success" id="div-box"> 
                <div class="box-body">            
                    <div class="alert alert-default alert-dismissible align-center invisivel" id="divAlerta">
                        <label>Excluído</label>                        
                    </div>			
                    <section class="row text-center dados">         
                        <div class="col-12 col-sm-4 dado">
                            <h4 style="text-align:center;"> R$  {{ number_format($model->valor, 2 ,',', '')}}  </h4>
                        </div>                         
                        <div class="col-12 col-sm-4 dado">
                           <h4 style="text-align:center;">  {{ $model->descricao}}  </h4>
                        </div>                                     
                        <div class="col-12 col-sm-4 dado">
                            <h4 style="text-align:center;">  {{ $model->categoria}}  </h4>
                        </div> 	
                    </section>
                </div>
                <div class="box-footer align-right">
                    <button   style="margin-left: 5px;" type="button" class="btn btn-default"  onclick="modelVoltarIndex()" > <i class="fa fa-reply"></i> Voltar </button>            
                </div>
            </div>
        </div>
    </div>
</section>