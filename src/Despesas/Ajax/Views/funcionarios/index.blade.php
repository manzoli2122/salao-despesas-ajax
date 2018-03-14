@extends( Config::get('app.templateMasterJson' , 'templates.templateMasterJson')  )

@section( Config::get('app.templateMasterContent' , 'content')  )
<section class="content-header">
	<h1>
		<span id="div-titulo-pagina">Listagem dos Funcionarios </span>		
	</h1>
</section>	
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-success">
				<div class="box-body" style="padding-top: 5px; padding-bottom: 3px;">
					<table class="table table-bordered table-striped table-hover" id="datatable">
						<thead>	
							<tr>
								<th style="max-width:20px">ID</th>
								<th pesquisavel>Nome</th>								
								<th class="align-center" style="width:140px">Ações</th>
							</tr>
						</thead>
					</table>	
				</div>
			</div>
		</div>
	</div>
</section>

								
@endsection



@push(Config::get('app.templateMasterScript' , 'script') )
	
	<script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>

	<script>

		var pagianIndex = document.getElementById("div-pagina").innerHTML;		
		function modelIndexDataTableFunction() {
			var dataTable = datatablePadrao('#datatable', {
				order: [[ 1, "asc" ]],
				ajax: { 
					url:'{{ route('funcionarios.ajax.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' ,  visible: @perfil('Admin') true @else false  @endperfil },
					{ data: 'name', name: 'name' },					
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});
	
			dataTable.on('draw', function () {
				

				$('[btn-show]').click(function (){					
					modelShow($(this).data('id'), "{{ route('funcionarios.ajax.index') }}",
						function(data){							
							document.getElementById("div-pagina").innerHTML = data ;						
						}
					);                 
				});

				

			});

		}


		$(document).ready(function() {
			modelIndexDataTableFunction();
		});






		window.funcionario_pagar_salario = function( url , funcSucesso = function() {} , funcError = function() {} ) {			
			alertProcessando();
			var token = document.head.querySelector('meta[name="csrf-token"]').content;
			$.ajax({
				url: url ,
				type: 'post',
				data: { _token: token },
				success: function(retorno) {
					alertProcessandoHide();							
					if (retorno.erro) {	
						toastErro( retorno.msg );						
						funcError();             
					} 
					else {
						document.getElementById("div-pagina").innerHTML = retorno.data ;
						funcSucesso();	
					}											
				},
				error: function(erro) {
					alertProcessandoHide();
					toastErro("Ocorreu um erro");
					console.log(erro);
				}
			});		
		}
		





	</script>



@endpush
