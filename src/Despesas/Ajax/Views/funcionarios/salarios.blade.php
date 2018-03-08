@extends( Config::get('app.templateMaster' , 'templates.templateMaster')  )




@section( Config::get('app.templateMasterContent' , 'contentMaster')  )
	<section class="row text-center placeholders">
         
		<div class="col-12 col-sm-12 placeholder">
			<h5 style="text-align:center;">Funcionario: {{$funcionario->name}} </h5>
        </div>  
		
		
		

		<div class="col-12 col-sm-12 placeholder">
		<hr>
			@forelse($funcionario->salarios as $salario)

				 <div class="row">	
                    
					<div class="col-3 text-left">
								
                        {{ $salario->created_at->format('d/m/Y')}}						
                    </div>
                    <div class="col-6 text-left">			
                        <p><b> R$ {{number_format($salario->valor , 2 ,',', '')}}  </b>    </p>						
                        
                    </div>
                    
                </div>
                
                <hr>

			@empty
										
					
				
			@endforelse
        </div> 
		
		
			
    </section>



		

@endsection