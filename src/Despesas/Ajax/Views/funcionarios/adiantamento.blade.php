<section class="content-header">
    <h1>
        <span id="div-titulo-pagina">Cadastrar Adiantamento para {{ $model->name}}</span>
        <small id="div-small-content-header" > Valor Máximo do Adiantamento R$ {{number_format($model->valorSalarioLiquido(), 2 ,',' , '')}} </small>
    </h1>
</section>			
<section class="content">
    <div class="row"> 
        <div class="col-12 col-sm-12 comissoes" style="margin-bottom:10px; ">
            <div class="box">	
                <form id="form-model" method="POST" action="{{route('adiantamento.ajax.cadastrar', $model->id)}}"  >
                    {{csrf_field()}}
                    <input name="funcionario_id" value="{{$model->id}}" type="hidden">
                    <input name="tipo" value="adiantamento" type="hidden">					                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">                                    
                                <div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
                                    <label for="descricao">Descrição</label>
                                    <input placeholder="Descrição" class="form-control" name="descricao" type="text"> 
                                    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}                                        
                                </div>   
                                
                                <div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
                                    <label for="valor">Valor</label>
                                    <input placeholder="Valor" step="0.01" class="form-control"  name="valor" type="number">                                         
                                    {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}                                        
                                </div> 
                            
                            </div>
                        </div>  
                    </div>                          
                </form>
                		                        
                <div class="box-footer align-right">
                    <button type="button" class="btn btn-default"  
                        onclick="modelShow(  {{$model->id}} , '{{ route('funcionarios.ajax.index') }}' , function(data){	document.getElementById('div-pagina').innerHTML = data ; }); " > 
                        <i class="fa fa-reply"></i> Voltar 
                    </button>  
                    <button  style="margin-left: 5px;" class="btn btn-success" onclick="modelStore( '{{ route('adiantamento.ajax.cadastrar', $model->id ) }}'   )" >
                        <i class="fa fa-check"></i> Salvar
                    </button>                          
                </div>				
            </div>				 
        </div>
    </div>
</section>