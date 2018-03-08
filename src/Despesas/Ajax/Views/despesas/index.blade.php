@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )
	Listagem das Despesas
@endsection



@section( Config::get('app.templateMasterMenuLateral' , 'menuLateral')  )				
	@permissao('despesas-apagados')
		<li><a href="{{  route('despesas.apagados')}}"><i class="fa fa-circle-o text-red"></i> <span>Despesas Apagadas</span></a></li>
	@endpermissao
@endsection


@section( Config::get('app.templateMasterContentTituloSmallRigth' , 'small-content-header-right')  )
	@permissao('operadoras-cadastrar')
        <a href="{{ route('despesas.create')}}" class="btn btn-success btn-sm" title="Adicionar uma nova Operadora">
			<i class="fa fa-plus"></i> Cadastrar Despesa
		</a>	
	@endpermissao 		
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

		

@section( Config::get('app.templateMasterContent' , 'content')  )

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

@endsection


@push(Config::get('app.templateMasterScript' , 'script') )
	<script src="{{ mix('js/datatables-padrao.js') }}" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			var dataTable = datatablePadrao('#datatable', {
				order: [[ 0, "asc" ]],
				ajax: { 
					url:'{{ route('despesas.getDatatable') }}'
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
					excluirRecursoPeloId($(this).data('id'), "@lang('msg.conf_excluir_o', ['1' => 'despesas'])", "{{ route('despesas.apagados') }}", 
						function(){
							dataTable.row( $(this).parents('tr') ).remove().draw('page');
						}
					);
				});
			});
		});
	</script>
@endpush
