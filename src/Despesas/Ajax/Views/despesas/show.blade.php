@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )


@section( Config::get('app.templateMasterContentTitulo' , 'titulo-page')  )			
		{{$model->tipo}}
	@endsection

@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
        
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

        <br>
        <a class="btn btn-warning btn-sm" href="{{ URL::previous()}}">Voltar</a>

    @endsection

