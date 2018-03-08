
@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )			
		Adicionar Despesa
@endsection
    

@section( Config::get('app.templateMasterContent' , 'content')  )


<div class="col-md-12">
    <div class="box box-success">

        <form method="post" action="{{route('despesas.store')}}">
            
            {{csrf_field()}}
            <input name="tipo" type="hidden" value="despesa">
            
            @include('despesas::despesas._form', ['model' => new Manzoli2122\Salao\Despesas\Models\Despesa()])

            <div class="box-footer align-right">
                <a class="btn btn-default" href="{{ URL::previous() }}">
                    <i class="fa fa-reply"></i> Cancelar
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Salvar
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
