@extends('templates.master')

@section('conteudo-view')
    
<header>
<h1>Nome do grupo: {{ $group->name }}</h1>
<h2>Instituição: {{ $group->instituition->name }}</h2> <!-- pega a variável name de instituição através do relacionamento entre grupo e instituição -->
<h2>Responsável: {{ $group->user->name }}</h2>
</header>
<form method="post" action=" {{ route('group.user.store', ['id'=> $group->id]) }} ">
    {!! csrf_field() !!}
    @include('templates.formulario.select', [   'label' => "Usuário",
                                                'select' => 'user_id',
                                                'data' => $user_list,
                                                'name_select' => 'user_id',
                                                'attributes' => ['placeholder' => "User"]])
<button class="btn btn-1" type="submit">Relacionar ao Grupo: {{ $group->name }}</button>
</form> 

@include('user.list', ['user_list' => $group->users])

@endsection