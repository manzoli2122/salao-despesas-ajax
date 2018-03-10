<section class="content-header">
        <h1>
            <span id="div-titulo-pagina">{{$model->name}}</span>
            <small id="div-small-content-header" > {{$model->email}} </small>
        </h1>
    </section>			
    <section class="content">
        <div class="row">
            <section class="text-center relatorio"> 
                <div class="col-12 col-sm-12 comissoes" style="margin-bottom:10px; ">
                    <div class="box">
                        <div class="box-header">
                            <h1 class="box-title">SERVIÇO A SEREM PAGOS </h1>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-condensed text-center table-striped">
                                <thead>	
                                    <tr>
                                        <th style="max-width:20px">ID</th>
                                        <th> Data </th>
                                        <th> Nome </th>
                                        <th> Cliente </th>	
                                        <th> Valor Bruto </th>							
                                        <th> Valor Liquido </th
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($model->AtendimentosSemSalario() as $atendimento)
                                        <tr>
                                            <td> {{$atendimento->id}} </td>								
                                            <td> {{$atendimento->created_at->format('d/m/Y')}} </td>
                                            <td> {{$atendimento->servico->nome}} </td>
                                            <td> 
                                                @if($atendimento->cliente->apelido!= '')
                                                    {{$atendimento->cliente->apelido}}
                                                @else 
                                                    {{$atendimento->cliente->name}}
                                                @endif 
                                            </td>
                                            <td> R$ {{number_format($atendimento->valor, 2 ,',' , '')}} </td>
                                            <td> R$ {{number_format($atendimento->valorFuncioanrio(), 2 ,',' , '')}} </td>
                                        </tr>
                                    @empty
                                    @endforelse 
                                    <tr style="color:green ; font-size:20px;font-weight: bold;">
                                        <td></td><td></td><td></td>
                                        <td> TOTAL </td>
                                        <td> R$ {{number_format($model->AtendimentosSemSalario()->sum('valor') , 2 ,',' , '')}} </td>
                                        <td> R$ {{number_format( $model->valorBrutoSalario() , 2 ,',' , '')}} </td>
                                    </tr>
                                </tbody>					
                            </table>
                        </div>					
                    </div>				 
                </div>
            </section>	
    
    
    
    
    
    
    
            <section class="text-center relatorio"> 
                <div class="col-12 col-sm-12 comissoes" style="margin-bottom:10px; ">
                    <div class="box">
                        <div class="box-header">
                            <h1 class="box-title">ADIANTAMENTOS REALIZADOS </h1>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-condensed text-center table-striped">
                                <thead>	
                                    <tr>
                                        <th style="max-width:20px">ID</th>
                                        <th> Data </th>
                                        <th> Descrição </th>
                                        <th> Valor  </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($model->AdiantamentosSemSalario() as $adiantamento)
                                        <tr>
                                            <td> {{$adiantamento->id}} </td>	
                                            <td> {{$adiantamento->created_at->format('d/m/Y')}}  </td>
                                            <td> {{$adiantamento->descricao}} </td>
                                            <td>  {{number_format($adiantamento->valor, 2 ,',' , '')}}  </td>
                                        </tr>
                                    @empty
                                    @endforelse 
                                    <tr style="color:red; font-size:20px;font-weight: bold;">
                                        <td></td><td></td>
                                        <td> TOTAL </td>
                                        <td> R$ {{number_format( $model->AdiantamentosSemSalario()->sum('valor') , 2 ,',' , '')}} </td>
                                    </tr>
                                </tbody>					
                            </table>
                        </div>					
                    </div>				 
                </div>
            </section>	
    
    
    
            
            <section class="text-center relatorio"> 
                <div class="col-12 col-sm-12 comissoes" style="margin-bottom:10px; ">
                    <div class="box">
                        <div class="box-header">
                            <h1 class="box-title"> RESUMO </h1>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-condensed text-center table-striped">
                                <thead>	
                                    <tr>
                                        <th> Total de Comissões  </th>
                                        <th> Total de Adiantamento </th>
                                        <th> Valor a Receber </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>									
                                    <tr style="font-size:20px;font-weight: bold;">
                                        <td style="color:green;">  R$ {{number_format( $model->valorBrutoSalario() , 2 ,',' , '')}}</td>
                                        <td style="color:red;">  R$ {{number_format( $model->AdiantamentosSemSalario()->sum('valor') , 2 ,',' , '')}} </td>
                                        <td style="color:blue;">  R$ {{number_format( $model->valorBrutoSalario() - $model->AdiantamentosSemSalario()->sum('valor') , 2 ,',' , '') }} </td>										
                                    </tr>
                                </tbody>					
                            </table>
                        </div>					
                    </div>				 
                </div>
            </section>	
    
            
                <section class="text-center relatorio"> 
                    <div class="col-12 col-sm-12 comissoes" style="margin-bottom:10px; ">
                        <div class="box">						
                            <div class="box-footer align-right">
                                    <button type="button" class="btn btn-default"  
                                            onclick="modelShow(  {{$model->id}} , '{{ route('funcionarios.ajax.index') }}' , function(data){	document.getElementById('div-pagina').innerHTML = data ; }); " > 
                                        <i class="fa fa-reply"></i> Voltar 
                                    </button> 
                                @if($model->valorBrutoSalario() - $model->AdiantamentosSemSalario()->sum('valor') > 0 )
                                    @permissao('salario-cadastrar')
                                        <button  style="margin-left: 5px;" class="btn btn-success btn" onclick="funcionario_pagar_salario( '{{ route('salario.ajax.cadastrar' , $model->id ) }}'   )" title="Pagar Salário">
                                            <i class="fa fa-plus"></i> PAGAR SALÁRIO
                                        </button>
                                    @endpermissao 
                                @endif
                            </div>				
                        </div>				 
                    </div>
                </section>
            
                
    
        </div>
    </section>			