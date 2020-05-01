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
</head>
<body>

    <div class="background">

    </div>

    </section>
    <section id="conteudo-view" class="login">
        <h1>Investindo</h1>
        <h3>O nosso gerenciador de investimentos</h3>
        <form method= "post" action=" {{ route('user.login') }} ">
            {!! csrf_field() !!}
            <p>Acesse o sistema</p>

            <label for="exampleInputEmail1">
               <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Email">
            </label>
            <label for="exampleInputPassword1">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </label>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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