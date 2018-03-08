<div class="modal fade bd-example-modal-lg" id="adiantamentoModal{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="adiantamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:orange; color:white;">                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 style="margin-left:50px;" class="modal-title" id="exampleModalLabel"><b>Adicionar Adiantamento</b></h4>
            </div>
            <div class="modal-body">                 
                <h3> Valor Máximo do Adiantamento R$ {{number_format($model->valorSalarioLiquido(), 2 ,',' , '')}}</h3>
                <form method="POST" action="{{route('adiantamento.store', $model->id )}}" accept-charset="UTF-8" class="form form-search form-ds">
                    {{csrf_field()}}
                    <input name="funcionario_id" value="{{$model->id}}" type="hidden">
                    <input name="tipo" value="adiantamento" type="hidden">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="descricao" class="col-form-label text-right">Descrição:</label>
                                <input placeholder="Descrição" class="form-control" name="descricao" type="text">                                 
                            </div>

                            <div class="form-group">
                                <label for="valor" class="col-form-label text-right">Valor:</label>
                                <input placeholder="Valor" step="0.01" class="form-control" max="{{$model->valorSalarioLiquido()}}" name="valor" type="number">              
                            </div>                        
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="col-5 col-md-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>                        
                        <div class="col-5 col-md-5 ml-auto">
                            <div class="form-group">
                                <input class="btn btn-warning" value="Enviar" type="submit">
                            </div>
                        </div>
                    </div>
                </form>           
            </div>            
        </div>
    </div>
</div>