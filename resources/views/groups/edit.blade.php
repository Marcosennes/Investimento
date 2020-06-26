@extends('templates.master')

@section('conteudo-view')

@if(session('success'))
    <h3>{{ session('success')['messages'] }}</h3>
@endif

<div class="offset-lg-2 col-12 col-lg-8" style="background-color: white">
    <div class="row d-flex flex-column">
        <form method="post" action=" {{ route('group.update', ['id' => $group->id]) }} ">
            {!! csrf_field() !!}
            <!--Campo que especifica o tipo de envio (verbon http) do formulário: PUT. É necessário para que o envio aconteça-->            
            <div class="ml-3 mr-3 d-flex flex-column">
                <div class="mt-3">
                    <h2 style="color: black">Editar Grupo</h2>
                </div>
                <label for="editGroup">
                    <span style="color: black">Nome</span>
                    <input type="text" class="form-control" name="name" value="{{ $group->name }}" placeholder="Nome do Grupo">
                </label>
                <br>
                <label for="responsavel">
                    @include('templates.formulario.select', [   
                                                                'label' => "Responsável",
                                                                'select' => 'user_id',
                                                                'data' => $user_list,
                                                                'name_select' => 'user_id',
                                                                'attributes' => ['placeholder' => "User"]
                                                            ])
                </label>
                <button class="btn btn-black" type="submit">Atualizar</button>
            </div>
        </form> 
    </div>
</div>

@endsection