@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )			
	Listagem dos Funcionarios						
@endsection

@push( Config::get('app.templateMasterCss' , 'css')  )			
	<style type="text/css">
		.btn-group-sm>.btn, .btn-sm {
			padding: 1px 10px;
			font-size: 15px;		
		} 
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
			padding: 5.5px;
		}
	</style>
@endpush

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
			
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-body" style="padding-top: 5px; padding-bottom: 3px;">
				<table class="table table-hover table-striped">
					<tr>
						<th>Nome</th>
						<th></th>
						<th>Adiantamento</th>
						<th>Salário</th>
					</tr>
					@forelse($models as $model)		
						<tr>
							<td> {{$model->name}} </td>	
							<td>
								@permissao('funcionarios')								
									<a class="btn btn-success btn-sm" href='{{route("funcionarios.show", $model->id)}}'>
										<i class="fa fa-eye" aria-hidden="true"></i>Exibir</a>								
								@endpermissao							
							</td>
							<td>
								@permissao('adiantamento-cadastrar')
									<a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#adiantamentoModal{{$model->id}}">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Cadastrar  
									</a>
								@endpermissao											
							</td>
							<td>
								@permissao('salario-cadastrar')
									<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#salarioModal{{$model->id}}">
										<i class="fa fa-plus" aria-hidden="true"></i>
										Cadastrar  
									</a>
								@endpermissao											
							</td>
						</tr>
					@empty									
					@endforelse
				</table>			
			</div>
		</div>
	</div>

	@forelse($models as $model)	
		@include('despesas::funcionarios.modalAdiantamento')
		@include('despesas::funcionarios.modalSalario')
	@empty									
	@endforelse
								
@endsection