@extends('templates.master')

@section('conteudo-view')

@if(session('success'))
    <h3>{{ session('success')['messages'] }}</h3>
@endif

<div class="offset-lg-2 col-12 col-lg-8" style="background-color: white">
    <div class="row d-flex flex-column">
        <form method= "post" action=" {{ route('user.update', ['id' => $user->id]) }} ">
            {!! csrf_field() !!}
            <!--Campo que especifica o tipo de envio (verbon http) do formulário: PUT. É necessário para que o envio aconteça-->            
            <div class="ml-3 mr-3 d-flex flex-column">
                <input name="_method" type="hidden" value="PUT">
                <div class="mt-3">
                    <h2 style="color: black">Editar</h2>
                </div>            
                <label for="cpfInputEmail1">
                    <span style="color: black">CPF</span>
                    <input type="text" class="form-control" name="cpf" aria-describedby="cpfHelp" value="{{ $user->cpf }}" placeholder="CPF">
                </label>
                <label for="nameInputPassword1">
                    <span style="color: black">Nome</span>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Name">
                </label>
                <br>
                <label for="phoneInputPassword1">
                    <span style="color: black">Celular</span>
                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Phone">
                </label>
                <label for="emailInputPassword1">
                    <span style="color: black">Email</span>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
                </label>
                <br>
                <label for="exampleInputPassword2">
                    <span style="color: black">Senha</span>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </label>
                <button class="btn btn-black" type="submit">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection