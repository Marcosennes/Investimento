@extends('templates.master')

@section('conteudo-view')

<header>
<h1>{{ $instituition->name }}</h1>
</header>

@include('groups.list', ['group_list' => $instituition->groups, 'user_permission' => $user_permission])





@endsection