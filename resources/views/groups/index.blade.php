@extends('templates.master')

@section('conteudo-view')
<div class="row">
    <div class="col-md-3">
        </div>
        <div class="col-md-6" style="float: ">
            <h4>Cadastrar novo grupo</h4>
            <form method="post" action=" {{ route('group.store') }} ">
                {!! csrf_field() !!}
                <label for="registerNameGroup">
                    <input type="text" class="form-control" name="name" placeholder="Nome do Grupo">
                </label>
                @include('templates.formulario.select', ['label' => "Usuário",     'select' => 'user_id',         'data' => $user_list,         'name_select' => 'user_id',     'attributes' => ['placeholder' => "User"]])
                @include('templates.formulario.select', ['label' => "Instituição", 'select' => 'instituition_id', 'data' => $instituition_list, 'name_select' => 'instituition_id', 'attributes' => ['placeholder' => "Instituição"]])
                <br>
                <button class="btn btn-1" style="float: right; margin-right: 125px;" type="submit">Cadastrar</button>
            </form> 
        </div>
</div>
<div class="col-md-12">

    @include('groups.list', ['group_list' => $groups])


</div>

@endsection