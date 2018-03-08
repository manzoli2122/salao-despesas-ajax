@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )




@section( Config::get('app.templateMasterContent' , 'contentMaster')  )

    <section class="row text-center placeholders">
        <div class="col-12 col-sm-12 placeholder">
			<h5 style="text-align:center;">Cadastrar Adiantamento para {{ $funcionario->name}}</h5>
        </div>        
    </section>

    <section class="row text-center placeholders">
        <div class="col-12 col-sm-12 placeholder">
            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-warning">
                    @foreach($errors->all() as $erro)
                        <p>{{$erro}}</p>
                    @endforeach
                </div>
            @endif
        </div>        
    </section>


    <section class="row text-center placeholders">
        <div class="col-2 col-sm-2 placeholder"></div>
        <div class="col-8 col-sm-8 placeholder">
                <form method="POST" action="{{route('adiantamento.createAdiantamento')}}" accept-charset="UTF-8" class="form form-search form-ds">
                    {{csrf_field()}}
               
                    <input name="funcionario_id" value="{{$funcionario->id}}" type="hidden">
                    <input name="tipo" value="adiantamento" type="hidden">

                    <div class="form-group">
                        <label for="descricao" class="col-form-label">Descrição:</label>
                        <input placeholder="Descrição" class="form-control" name="descricao" type="text"> 
                    </div>
                    <div class="form-group">
                        <label for="valor" class="col-form-label">Valor:</label>
                        <input placeholder="Valor" step="0.01" class="form-control" max="22.5" name="valor" type="number">
                    </div>
                        
                    <div class="form-group">
                        <input class="btn btn-warning" value="Enviar" type="submit">
                    </div>                             
                </form>
            </div>   
        <div class="col-2 col-sm-2 placeholder"></div>     
    </section>
@endsection