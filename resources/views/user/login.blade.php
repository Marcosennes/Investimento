<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="php" href="{{ asset('/../../../bootstrap/app.php') }}" rel="stylesheet">
    <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href=" {{ asset('css/stylesheet.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
<body>

    <div class="background">

    </div>

    </section>
    <section id="conteudo-view" class="login">
        <h1>Investindo</h1>
        <h3>O nosso gerenciador de investimentos</h3>
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <div id="login">
            <form method= "post" action=" {{ route('dashboard.auth') }} ">
                {!! csrf_field() !!}
                <p>Acesse o sistema</p>
    
                <label for="exampleInputEmail1">
                   <input type="email" class="form-control" required name="email" aria-describedby="emailHelp" placeholder="Email">
                </label>
                <label for="exampleInputPassword1">
                    <input type="password" class="form-control" required name="password" placeholder="Password">
                </label>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if(session('wrongPassword'))
                <h3 style="color: red;">{{ session('wrongPassword')['messages'] }}</h3>
            @endif
            @if(session('email_fail'))
                <h3 style = "color: red;">{{ session('email_fail')['messages'] }}</h3>
            @endif
            @if(session('none_user'))
                <h3 style = "color: red;">{{ session('none_user')['messages'] }}</h3>
            @endif
            <h3 style="font-size: 19px; margin-top: 20px;">
                Ainda não é registrado?
                <button class="btn btn-primary botaoRegister" id="register_button">Register</button>
            </h3>    
        </div>
        <div id="register" style="display: none;">
            <form id="form_register" method= "post" action=" {{ route('login.register') }} ">
                {!! csrf_field() !!}
                <label for="cpfInputCpf">
                   <input type="text" id="cpf" class="form-control" required name="cpf" aria-describedby="cpfHelp" placeholder="CPF">
                </label>
                <div style="display: none" id="cpf_incorreto">
                    <span style="color: red;">CPF deve possuir 11 dígitos</span>
                </div>
                <label for="nameInputName">
                    <input type="text" id="usernamesignup" class="form-control" required name="name" placeholder="Name">
                </label>
                <div style="display: none" id="nome_cadastro_vazio">
                    <span style="color: red;">Preencha o nome</span>
                </div>
                <br>
                <label for="phoneInputPhone">
                    <input type="text" id="phone" class="form-control" required name="phone" placeholder="Phone">
                </label>
                <div style="display: none" id="phone_incorreto">
                    <span style="color: red;">Deve possuir somente números</span>
                </div>
                <label for="email">
                    <input type="email" id="emailsignup" class="form-control" required name="email" placeholder="Email">
                </label>
                <div style="display: none" id="email_cadastro_vazio">
                    <span style="color: red;">Preencha o E-mail</span>
                </div>
                <br>
                <label for="exampleInputPassword">
                    <input type="password" class="form-control" required name="password" placeholder="Password">
                </label>
                <div style="display: none" id="password_cadastro_vazia">
                    <span style="color: red;">A senha deve possuir pelo menos 5 caracteres</span>
                </div>
                <label for="exampleInputConfirmPassword">
                    <input type="password" class="form-control" required id="passwordsignup_confirm" name="confirm_password" placeholder="Confirm Password">
                </label>
                <div style="display: none" id="password_confirm_cadastro_vazia">
                    <span style="color: red;">Preencha a senha</span>
                </div>

                <button type="submit" style="width: 226px;" class="btn btn-1">Cadastrar</button>
                
                <div style="display: none" id="senhas_diferentes">
                    <span style="color: red;">As senhas informadas não correspondem</span>
                </div>
                <div style="display: none" id="email_ja_cadastrado">
                    <span style="color: red;">O E-mail já se encontra cadastrado</span>
                </div>
            </form>
            
            <button class="btn-1 btn-primary" id="login_button">Login</button>
        </div>

    </section>  

    <!--
    <div class="row">
        <div class="col-lg-8" style="background: black">
            dasads
        </div>
        <div class="col-lg-4" style="height: 100%; position:absolute; right: 0;  background: cyan">
            adad
        </div>
    </div>
    -->
    
</body>
</html>

<script>
    $(document).ready(function()
    {
        $('#passwordsignup_confirm').removeAttr('name');
        $("#register_button").click(function()
        {
            $('#register').show();
            $("#login").hide();
        })

        $("#login_button").click(function()
        {
            $("#login").show();
            $('#register').hide();
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#form_register').submit(function(event) {
    
            var oCadastrar = {
                cpf:                            $('#cpf').val(),
                nome_cadastro:                  $('#usernamesignup').val(),
                phone:                          $('#phone').val(),
                email_cadastro:                 $('#emailsignup').val(),
                password_cadastro:              $('#passwordsignup').val(),
                password_confirmacao_cadastro:  $('#passwordsignup_confirm').val(),
            }
            
            $('#nome_cadastro_vazio').hide();
            $('#email_cadastro_vazio').hide();
            $('#email_ja_cadastrado').hide();
            $('#password_cadastro_vazia').hide();
            $('#password_confirm_cadastro_vazia').hide();
            $('#senhas_diferentes').hide();
    
            if (oCadastrar.nome_cadastro        == '' || oCadastrar.email_cadastro                  == '' || oCadastrar.password_cadastro.length    < 5 ||
                oCadastrar.password_cadastro    == "" || oCadastrar.password_confirmacao_cadastro   == "" || oCadastrar.password_cadastro           != oCadastrar.password_confirmacao_cadastro)
                {
                if (oCadastrar.nome_cadastro == "") {
                    $('#nome_cadastro_vazio').show();
                    $('#usernamesignup').focus();
                }
                if (oCadastrar.email_cadastro == "") {
                    $('#email_cadastro_vazio').show();
                    if (oCadastrar.nome_cadastro != "" && oCadastrar.email_cadastro == "") {
                        $('#emailsignup').focus();
                    }
                }
                if (oCadastrar.password_cadastro.length < 5)
                {
                    $('#password_cadastro_vazia').show();

                    if (oCadastrar.nome_cadastro != "" && oCadastrar.email_cadastro != "" && oCadastrar.password_cadastro == "") {
                        $('#passwordsignup').focus();
                    }
                }
                if (oCadastrar.password_confirmacao_cadastro.length < 5)
                {
                    $('#password_confirm_cadastro_vazia').show();

                    if (oCadastrar.nome_cadastro != "" && oCadastrar.email_cadastro != "" && (oCadastrar.password_cadastro != "" || oCadastrar.password_cadastro.length >= 5) && oCadastrar.password_confirmacao_cadastro == "") {
                        $('#passwordsignup_confirm').focus();
                    }
                }
                if (oCadastrar.password_cadastro != "" && oCadastrar.password_confirmacao_cadastro != "" &&
                    oCadastrar.password_cadastro != oCadastrar.password_confirmacao_cadastro) {
                    $('#senhas_diferentes').show();
                }
            }
            event.preventDefault();
        });
    });
</script>