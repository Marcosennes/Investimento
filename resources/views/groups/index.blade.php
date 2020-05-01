@extends('templates.master')

@section('conteudo-view')
    
<div class="col-md-6">
    <h3>Cadastrar novo grupo</h3>
    <form method="post" action=" {{ route('group.store') }} ">
        {!! csrf_field() !!}
        <label for="registerNameGroup">
            <input type="text" class="form-control" name="name" placeholder="Nome do Grupo">
        </label>
        <label for="user">
            <input type="text" class="form-control" name="user" placeholder="user">
        </label>
        <label for="instituition">
            <input type="text" class="form-control" name="instituition" placeholder="instituition">
        </label>
        <br>
        <button class="btn btn-1" type="submit">Cadastrar</button>
    </form> 
</div>

@endsection