@extends('templates.master')

@section('conteudo-view')

<div class="col-md-6">
    <h3>Cadastrar nova instituição</h3>
    <form method="post" action=" {{ route('instituition.update', ['id' => $instituition->id]) }} ">
        {!! csrf_field() !!}
        <!--Campo que especifica o tipo de envio (verbon http) do formulário: PUT. É necessário para que o envio aconteça-->            
        <input name="_method" type="hidden" value="PUT">
        <label for="registerInstituition">
            <input type="text" class="form-control" name="name" value="{{ $instituition->name }}" placeholder="Nome da Instituição">
        </label>
        <button class="btn btn-1" type="submit">Atualizar</button>
    </form> 
</div>

@endsection