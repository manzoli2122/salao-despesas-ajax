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
					<div class="box-footer align-right">
						<button   type="button" class="btn btn-default"  onclick="modelVoltarIndex()" > 
							<i class="fa fa-reply"></i> Voltar 
						</button> 
						@permissao('adiantamento-cadastrar')
							<button style="margin-left: 5px;" class="btn btn-warning btn" onclick="funcionario_pagar_salario(  '{{ route('funcionarios.ajax.adiantamento' , $model->id ) }}' ) " title="Salário">
								<i class="fa fa-plus"></i> CADASTRAR ADIANTAMENTO
							</button>
						@endpermissao 
						@permissao('salario-cadastrar')
							<button style="margin-left: 5px;" class="btn btn-success btn" onclick="funcionario_pagar_salario(  '{{ route('funcionarios.ajax.salario' , $model->id ) }}' ) " title="Salário">
								<i class="fa fa-plus"></i> CADASTRAR SALÁRIO
							</button>
						@endpermissao 
					</div>				
				</div>				 
			</div>
		</section>


		<section class="text-center relatorio"> 
			

			<div class="col-6 col-sm-6 comissoes" style="margin-bottom:10px; ">
				<div class="box">						
					<div class="box-header">
						<h1 class="box-title">PRODUÇÃO NOS ÚLTIMOS 7 DIAS</h1>
					</div>
					<div class="box-body no-padding">
						<table class="table table-condensed text-center table-striped">
							<thead>	
								<tr>
									<th>DESCRIÇÃO</th>
									<th> VALOR </th>										
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>TOTAL BRUTO JÁ PRODUZIDO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereBetween('created_at', [  today()->subDays(7) , now() ])->sum('valor')  , 2 ,',' , '.') }} </td>
								</tr>

								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO FUNCIONÁRIO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereBetween('created_at', [  today()->subDays(7) , now() ])->sum(\DB::raw('valor * porcentagem_funcionario / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
	
								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO SALÃO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereBetween('created_at', [  today()->subDays(7) , now() ])->sum(\DB::raw('valor * (100 - porcentagem_funcionario ) / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
							</tbody>					
						</table>
					</div>	
				</div>				 
			</div>




			<div class="col-6 col-sm-6 comissoes" style="margin-bottom:10px; ">
				<div class="box">						
					<div class="box-header">
						<h1 class="box-title"> PRODUÇÃO NESTE MÊS </h1>
					</div>
					<div class="box-body no-padding">
						<table class="table table-condensed text-center table-striped">
							<thead>	
								<tr>
									<th>DESCRIÇÃO</th>
									<th> VALOR </th>										
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>TOTAL BRUTO JÁ PRODUZIDO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereMonth('created_at',now()->month)->sum('valor')  , 2 ,',' , '.') }} </td>
								</tr>
		
								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO FUNCIONÁRIO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereMonth('created_at',now()->month)->sum(\DB::raw('valor * porcentagem_funcionario / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
		
								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO SALÃO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereMonth('created_at',now()->month)->sum(\DB::raw('valor * (100 - porcentagem_funcionario ) / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
							</tbody>					
						</table>
					</div>	
				</div>				 
			</div>
	



			

			<div class="col-6 col-sm-6 comissoes" style="margin-bottom:10px; ">
				<div class="box">						
					<div class="box-header">
						<h1 class="box-title"> PRODUÇÃO NESTE ANO </h1>
					</div>
					<div class="box-body no-padding">
						<table class="table table-condensed text-center table-striped">
							<thead>	
								<tr>
									<th>DESCRIÇÃO</th>
									<th> VALOR </th>										
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>TOTAL BRUTO JÁ PRODUZIDO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereYear('created_at',now()->year)->sum('valor')  , 2 ,',' , '.') }} </td>
								</tr>
			
								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO FUNCIONÁRIO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereYear('created_at',now()->year)->sum(\DB::raw('valor * porcentagem_funcionario / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
		
								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO SALÃO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->whereYear('created_at',now()->year)->sum(\DB::raw('valor * (100 - porcentagem_funcionario ) / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
							</tbody>					
						</table>
					</div>	
				</div>				 
			</div>
	
			<div class="col-6 col-sm-6 comissoes" style="margin-bottom:10px; ">
				<div class="box">						
					<div class="box-header">
						<h1 class="box-title">PRODUÇÃO TOTAL </h1>
					</div>
					<div class="box-body no-padding">
						<table class="table table-condensed text-center table-striped">
							<thead>	
								<tr>
									<th>DESCRIÇÃO</th>
									<th> VALOR </th>										
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>TOTAL BRUTO JÁ PRODUZIDO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->sum('valor')  , 2 ,',' , '.') }} </td>
								</tr>

								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO FUNCIONÁRIO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->sum(\DB::raw('valor * porcentagem_funcionario / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
	
								<tr>
									<td>TOTAL PRODUZIDO DESTINADO AO SALÃO </td>
									<td> R$ {{ number_format( $model->Atendimentos()->sum(\DB::raw('valor * (100 - porcentagem_funcionario ) / 100'))  , 2 ,',' , '.') }} </td>
								</tr>
							</tbody>					
						</table>
					</div>	
				</div>				 
			</div>
	
	

		</section>
	








	</div>
</section>			