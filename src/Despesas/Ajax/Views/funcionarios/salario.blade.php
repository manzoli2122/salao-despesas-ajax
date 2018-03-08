@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )



@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
	<section class="row text-center placeholders">
        <div class="col-12 col-sm-12 placeholder">
			<h4 style="text-align:center;"> Cadastro de Salário </h4>
        </div>  
		<div class="col-12 col-sm-12 placeholder">
			<h5 style="text-align:center;">Funcionario: {{$funcionario->name}} </h5>
        </div>  
		
		<div class="col-12 col-sm-12 placeholder">
		<hr>
			<h4 style="text-align:center;">Serviços Realizados</h4>
        </div>  
		





		<div class="col-12 col-sm-12 placeholder">
		<hr>
			@forelse($servicos as $servico)

				 <div class="row">	
                    <div class="col-4 text-left">			
                        <p><b>{{$servico->servico->nome}}  </b>    </p>						
                        
                    </div>
					<div class="col-2 text-right">
						{{-- Carbon\Carbon::parse($servico->created_at)->format('d/m/Y ') --}}			
                        {{ $servico->created_at->format('d/m/Y')}}						
                    </div>
                    <div class="col-2 text-right">			
                        <p> Valor R$ {{$servico->servico->valor - $servico->desconto  }} </p>						
                    </div>
					<div class="col-2 text-right">			
                        <p> Porc. Funcionario {{$servico->servico->porcentagem_funcionario }}% </p>						
                    </div>
					<div class="col-2 text-right">			
                        <p> Liquido R$ {{ number_format( ($servico->servico->valor - $servico->desconto) * ($servico->servico->porcentagem_funcionario / 100 )  , 2 ,',', '') }} </p>						
                    </div>
                </div>
                
                <hr>

			@empty
										
					<p>Nenhum usuario encontrado</td>
				
			@endforelse
        </div> 
		






		<div class="col-12 col-sm-12 placeholder">
		<hr>
			<h4 style="text-align:center;">Adiantamentos</h4>
        </div>  
		





		<div class="col-12 col-sm-12 placeholder">
		<hr>
			@forelse($adiantamentos as $adiantamento)

				 <div class="row">	
                    <div class="col-4 text-left">			
                        <p><b>{{ $adiantamento->descricao }}  </b>    </p>						
                        
                    </div>
					<div class="col-4 text-right">
						{{-- Carbon\Carbon::parse($servico->created_at)->format('d/m/Y ') --}}			
                        {{ $adiantamento->created_at->format('d/m/Y')}}						
                    </div>
                    <div class="col-4 text-right">			
                        <p> Valor R$ {{  number_format($adiantamento->valor  , 2 ,',', '')  }} </p>						
                    </div>
					
                </div>
                
                <hr>

			@empty
										
					<p>Nenhum usuario encontrado</td>
				
			@endforelse
        </div> 
		



		<div class="col-12 col-sm-12 placeholder">
			<br>
			<a class="btn btn-success" href='{{route("salario.createSalario", $funcionario->id)}}' class="">Cadastrar</a>
        </div> 
			
    </section>



		

@endsection