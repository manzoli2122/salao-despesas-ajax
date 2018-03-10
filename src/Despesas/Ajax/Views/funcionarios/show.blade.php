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

	</div>
</section>			