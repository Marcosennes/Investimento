@extends('templates.master')

@section('conteudo-view')

<div class="col-md-6">
    <h3>Editar Grupo</h3>
    <br>
    <form method="post" action=" {{ route('group.update', ['id' => $group->id]) }} ">
        {!! csrf_field() !!}
        <!--Campo que especifica o tipo de envio (verbon http) do formulário: PUT. É necessário para que o envio aconteça-->            
        <input name="_method" type="hidden" value="PUT">
        <label for="editGroup">
            <h3>Nome do grupo:</h3>
            <input type="text" class="form-control" name="name" value="{{ $group->name }}" placeholder="Nome do Grupo">
        </label>
        <br>
        <label for="responsavel">
            <h3>Nome do responsável:</h3>
            @include('templates.formulario.select', [   
                                                        'label' => "Usuário",
                                                        'select' => 'user_id',
                                                        'data' => $user_list,
                                                        'name_select' => 'user_id',
                                                        'attributes' => ['placeholder' => "User"]
                                                    ])
        </label>
        <button class="btn btn-1" type="submit">Atualizar</button>
    </form> 
</div>

@endsection