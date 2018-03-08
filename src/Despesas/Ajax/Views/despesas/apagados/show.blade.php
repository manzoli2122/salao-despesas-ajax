@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )

@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )        
        {{$model->tipo}}
@endsection

@section( Config::get('app.templateMasterContent' , 'content')  )

<div class="col-md-12">
    <div class="box box-success">
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
            @permissao('despesas-soft-delete')
                <button type="button" class="btn btn-danger" id='btnExcluir' remover-apos-excluir>
                    <i class="fa fa-times"></i> Excluir
                </button>
             @endpermissao
            @permissao('despesas-editar')
                <a href="{{route('despesas.edit', $model->id)}}" class="btn btn-success" title="Editar" remover-apos-excluir> 
                    <i class="fa fa-pencil"></i> Editar
                </a>
            @endpermissao
            <a class="btn btn-default" href="{{ URL::previous() }}">
                <i class="fa fa-reply"></i> Voltar
            </a>
        </div>
    </div>
</div>

@endsection



@push(Config::get('app.templateMasterScript' , 'script') )
<script>
    $(document).ready(function() {
        $('#btnExcluir').click(function (){
            excluirRecursoPeloId({{$model->id}}, "@lang('msg.conf_excluir_o', ['1' => 'despesa'])", "{{ route('despesas.apagados') }}", 
                function(){
                    $('[remover-apos-excluir]').remove();
                    $('#divAlerta').slideDown();
                }
            );
        });
    });
</script>
@endpush





            
           
