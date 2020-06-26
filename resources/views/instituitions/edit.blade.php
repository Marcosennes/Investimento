@extends('templates.master')

@section('conteudo-view')

<div class="offset-lg-2 col-12 col-lg-8" style="background-color: white">
    <div class="row d-flex flex-column">
        <form method="post" action=" {{ route('instituition.update', ['id' => $instituition->id]) }} ">
            {!! csrf_field() !!}
            <!--Campo que especifica o tipo de envio (verbon http) do formulário: PUT. É necessário para que o envio aconteça-->            
            <div class="ml-3 mr-3 d-flex flex-column">
                <div class="mt-3">
                    <h2 style="color: black">Editar Instituição</h2>
                </div>
                <label for="registerInstituition">
                    <span style="color: black">Nome</span>
                    <input type="text" class="form-control" name="name" value="{{ $instituition->name }}" placeholder="Nome da Instituição">
                </label>
                <button class="btn btn-black" type="submit">Atualizar</button>
            </div>
        </form> 
    </div>
</div>

@endsection