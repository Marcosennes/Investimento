@extends('templates.master')

@section('conteudo-view')

<div class="offset-1 offset-lg-4 col-10 col-lg-4" style="background-color: white">
    <div class="row d-flex flex-column">
        <div class="ml-3 mr-3 d-flex flex-column">
            <div class="mt-3">
                <h2 style="color: black">Grupo: {{ $group->name }}</h2>
                <h5 style="color: black">Responsável: {{ $group->user->name }}</h5>
            </div>
            @if($user_permission == "app.admin")
                <form method="post" action=" {{ route('group.user.store', ['id'=> $group->id]) }} ">
                {!! csrf_field() !!}
                @include('templates.formulario.select', 
                    [    'label'        => "Usuário",
                         'select'       => 'user_id',
                         'data'         => $user_list,
                         'name_select'  => 'user_id',
                         'attributes'   => ['placeholder' => "User"]])
                <br>
                <button class="btn btn-black" type="submit">Relacionar ao Grupo: {{ $group->name }}</button>
                </form> 
            @endif
        </div>
    </div>
</div>
<div class="mt-4">
    @include('user.list', ['user_list' => $group->users, 'user_permission' => $user_permission, 'user_id' => $user_id])
</div>

@endsection