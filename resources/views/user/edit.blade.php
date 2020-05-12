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
        <form method= "post" action=" {{ route('user.update', ['id' => $user->id]) }} ">
            {!! csrf_field() !!}
            <!--Campo que especifica o tipo de envio (verbon http) do formulário: PUT. É necessário para que o envio aconteça-->            
            <input name="_method" type="hidden" value="PUT">
            <p>Acesse o sistema</p>
            <label for="cpfInputEmail1">
                <input type="text" class="form-control" name="cpf" aria-describedby="cpfHelp" value="{{ $user->cpf }}" placeholder="CPF">
            </label>
            <label for="nameInputPassword1">
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Name">
            </label>
            <br>
            <label for="phoneInputPassword1">
                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Phone">
            </label>
            <label for="emailInputPassword1">
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
            </label>
            <br>
            <label for="exampleInputPassword2">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </label>
            <button type="submit" style="width: 226px;" class="btn btn-1">Atualizar</button>
        </form>
</body>
</html>
@endsection