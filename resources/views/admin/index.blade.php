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
    <div class="col-md-12">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6" style="background-color: aqua">
                <form method= "post" action=" {{ route('user.store') }} " ">
                    {!! csrf_field() !!}
                    <h3 style="color: white">Cadastrar novo usuário</h3>
                    <div class="container">
                        <div class="offset-2 col-8">
                            <div class="row d-flex flex-column">
                                <label for="cpfInputEmail1">
                                    <input  type="text" class="form-control" style="width: 100%" name="cpf" aria-describedby="cpfHelp" placeholder="CPF">
                                </label>
                            </div>
                            <div class="row d-flex flex-column">
                                <label for="nameInputPassword1">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </label>
                            </div>
                            <div class="row d-flex flex-column">
                                <label for="phoneInputPassword1">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                                </label>
                            </div>
                            <div class="row d-flex flex-column">
                                <label for="emailInputPassword1">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </label>
                            </div>
                            <div class="row d-flex flex-column">
                                <label for="exampleInputPassword2">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </label>
                                <button type="submit" class="btn btn-1" style="width: 100%">Cadastrar</button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6" style="background-color: brown">
                <h3 style="color: white">Cadastrar nova instituição</h3>
                <div class="container">
                    <div class="offset-2 col-8">
                        <form method="post" action=" {{ route('instituition.store') }} ">
                            {!! csrf_field() !!}
                                <div class="row d-flex flex-column">
                                    <label for="registerInstituition">
                                        <input type="text" class="form-control" name="name" placeholder="Nome da Instituição">
                                    </label>
                                    <button class="btn btn-1" style="width: 100%" type="submit">Cadastrar</button>
                                </div>
                            </form>    
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6" style="background-color: blueviolet">
                <h3 style="color: white">Cadastrar novo grupo</h3>
                <div class="container">
                    <div class="offset-2 col-8">
                        <form method="post" action=" {{ route('group.store') }} ">
                            {!! csrf_field() !!}
                            <div class="row d-flex flex-column">
                                <label for="registerNameGroup">
                                    <input type="text" class="form-control" name="name" placeholder="Nome do Grupo">
                                </label>
                            </div>
                            <div class="row d-flex flex-column">
                                @include('templates.formulario.select', ['label' => "Responsável",     'select' => 'user_id',         'data' => $user_list,         'name_select' => 'user_id',     'attributes' => ['placeholder' => "User"]])
                            </div>
                            <div class="row d-flex flex-column">
                                @include('templates.formulario.select', ['label' => "Instituição", 'select' => 'instituition_id', 'data' => $instituition_list, 'name_select' => 'instituition_id', 'attributes' => ['placeholder' => "Instituição"]])
                                <button class="btn btn-1" style="width: 100%" type="submit">Cadastrar</button>
                            </div>
                        </form>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection