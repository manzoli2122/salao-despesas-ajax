@extends( Config::get('app.templateMasterJson' , 'templates.templateMasterJson')  )

@section( Config::get('app.templateMasterContent' , 'content')  )
<section class="content-header">
	<h1>
		<span id="div-titulo-pagina">Listagem das Despesas </span>		
		<small style="float: right;">
			@permissao('operadoras-cadastrar')
				<button class="btn btn-success btn-sm" onclick="modelCreate( '{{ route('despesas.ajax.create') }}'   )" title="Adicionar uma nova Despesa">
					<i class="fa fa-plus"></i> Cadastrar Despesa 
				</button>
			@endpermissao 						
		</small>
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
								<th pesquisavel style="max-width:20px">ID</th>
								<th pesquisavel style="max-width:100px">Tipo</th>
								<th pesquisavel style="max-width:150px">Categoria</th>
								<th  >Descrição</th>
								<th pesquisavel style="max-width:120px">Data</th>
								<th>Valor</th>	
								<th class="align-center" style="width:120px">Ações</th>
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
				order: [[ 0, "asc" ]],
				ajax: { 
					url:'{{ route('despesas.ajax.getDatatable') }}'
				},
				columns: [
					{ data: 'id', name: 'id' },
					{ data: 'tipo', name: 'tipo' },
					{ data: 'categoria', name: 'categoria' },
					{ data: 'descricao', name: 'descricao' },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'valor', name: 'valor' },
				
					{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'align-center'}
				],
			});

			dataTable.on('draw', function () {
				
				$('[btn-excluir]').click(function (){
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'despesas'])", "{{ route('despesas.ajax.index') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});

				$('[btn-show]').click(function (){					
					modelShow($(this).data('id'), "{{ route('despesas.ajax.index') }}",
						function(data){							
							document.getElementById("div-pagina").innerHTML = data ;						
						}
					);                 
				});

				$('[btn-editar]').click(function (){					
					modelEditar($(this).data('id'), "{{ route('despesas.ajax.index') }}",
						function(){							
												
						} 	
					);                 
				});

			});


		}

		$(document).ready(function() {
			modelIndexDataTableFunction();
		});


	</script>
@endpush
