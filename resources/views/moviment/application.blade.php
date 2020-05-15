@extends('templates.master')

@section('conteudo-view')
    @if (session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @endif
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <h4>Cadastrar novo grupo</h4>
        <form method="post" action=" {{ route('moviment.application.store') }} ">
            {!! csrf_field() !!}
            @include('templates.formulario.select', ['label' => "Grupo",     'select' => 'group_id',   'data' => $user_group_list,         'name_select' => 'group_id',         'attributes' => ['placeholder' => "Grupo"]])
            @include('templates.formulario.select', ['label' => "Produto", 'select' => 'product_id', 'data' => $product_list, 'name_select' => 'product_id', 'attributes' => ['placeholder' => "Produto"]])
            <label for="registerNameGroup">
                <input type="text" class="form-control" name="value" placeholder="Valor">
            </label>
            <br>
            <button class="btn btn-1" style="float: right; margin-right: 125px;" type="submit">Cadastrar</button>
        </form> 
    </div>
</div>

@endsection