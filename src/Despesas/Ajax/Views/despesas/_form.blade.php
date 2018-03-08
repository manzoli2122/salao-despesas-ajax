<div class="box-body">	
     <div class="row">
        <div class="col-md-6">

            <div class="form-group {{ $errors->has('categoria') ? 'has-error' : ''}}">
                <label for="categoria">Nome</label>
                 <select class="form-control" name="categoria"  required>
                    <option value="">Selecione a Categoria</option>
                    <option value="energia" {{$model->categoria == 'energia' ? 'selected' : '' }}>  energia  </option>
                    <option value="água" {{$model->categoria == 'água' ? 'selected' : '' }}>  água  </option>
                    <option value="telefone" {{$model->categoria == 'telefone' ? 'selected' : '' }} >  telefone  </option>
                    <option value="internet"{{$model->categoria == 'internet' ? 'selected' : '' }} >  internet </option>
                    <option value="aluguel" {{$model->categoria == 'aluguel' ? 'selected' : '' }}>  aluguel  </option>
                    <option value="produtos" {{$model->categoria == 'produtos' ? 'selected' : '' }}>  produtos  </option>
                    <option value="impostos" {{$model->categoria == 'impostos' ? 'selected' : '' }}>  impostos  </option>
                    <option value="limpeza" {{$model->categoria == 'limpeza' ? 'selected' : '' }}>  limpeza  </option>
                    <option value="assessoria contábil" {{$model->categoria == 'assessoria contábil' ? 'selected' : '' }}>  assessoria contábil  </option>
                    <option value="manutenção" {{$model->categoria == 'manutenção' ? 'selected' : '' }} >  manutenção  </option>
                    <option value="avon" {{$model->categoria == 'avon' ? 'selected' : '' }} >  avon  </option>
                    <option value="Outros" {{$model->categoria == 'Outros' ? 'selected' : '' }} >  Outros  </option>
                </select>             
                {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
                <label for="valor">Valor</label>
                <input type="number" step="0.01" class="form-control" name="valor" placeholder="Valor"
                    value="{{$model->valor or old('valor')}}">
                {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
            </div>   
            
        </div>
        <div class="col-md-6">


            <div class="form-group {{ $errors->has('descricao') ? 'has-error' : ''}}">
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" name="descricao" placeholder="Descrição"
                    value="{{$model->descricao or old('descricao')}}">
                {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
            </div>

        </div> 
    </div> 
 </div>  
    