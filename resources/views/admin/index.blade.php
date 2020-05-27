@extends('templates.master')

@section('conteudo-view')

    @if(session('success'))
        <h3>{{ session('success')['messages'] }}</h3>
    @else
        <h3>Não houve retorno</h3>
    @endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Investindo</title>
</head>
<body>
    <div class="col-md-8">
        <form method= "post" action=" {{ route('user.store') }} " ">
            {!! csrf_field() !!}
            <h3>Cadastrar novo usuário</h3>
            <label for="cpfInputEmail1">
               <input type="text" class="form-control" name="cpf" aria-describedby="cpfHelp" placeholder="CPF">
            </label>
            <label for="nameInputPassword1">
                <input type="text" class="form-control" name="name" placeholder="Name">
            </label>
            <br>
            <label for="phoneInputPassword1">
                <input type="text" class="form-control" name="phone" placeholder="Phone">
            </label>
            <label for="emailInputPassword1">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </label>
            <br>
            <label for="exampleInputPassword2">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </label>
            <button type="submit" style="width: 226px;" class="btn btn-1">Cadastrar</button>
        </form>
        <h3>Cadastrar nova instituição</h3>
        <form method="post" action=" {{ route('instituition.store') }} ">
            {!! csrf_field() !!}
            <label for="registerInstituition">
                <input type="text" class="form-control" name="name" placeholder="Nome da Instituição">
            </label>
            <button class="btn btn-1" type="submit">Cadastrar</button>
        </form>
        <h3>Cadastrar novo grupo</h3>
        <form method="post" action=" {{ route('group.store') }} ">
            {!! csrf_field() !!}
            <label for="registerNameGroup">
                <input type="text" class="form-control" name="name" placeholder="Nome do Grupo">
            </label>
            @include('templates.formulario.select', ['label' => "Responsável",     'select' => 'user_id',         'data' => $user_list,         'name_select' => 'user_id',     'attributes' => ['placeholder' => "User"]])
            @include('templates.formulario.select', ['label' => "Instituição", 'select' => 'instituition_id', 'data' => $instituition_list, 'name_select' => 'instituition_id', 'attributes' => ['placeholder' => "Instituição"]])
            <br>
            <button class="btn btn-1" style="float: right; margin-right: 125px;" type="submit">Cadastrar</button>
        </form> 
    </div>
</body>
</html>
@endsection