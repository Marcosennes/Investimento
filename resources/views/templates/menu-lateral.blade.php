<nav id="principal">
    <ul class="lista">
        <li class="lista">
            <a id="a1" class="amenu" href="  {{ route('user.index') }}  ">
                <i class="imenu fas fa-user"></i>
                <h3 class="h3menu">Usuários</h3>
            </a>
        </li>
        <li class="lista">
        <a id="a1" class="amenu" href="{{ route('instituition.index') }}">
                <i class="imenu fas fa-hotel"></i>
                <h3 class="h3menu">Instituições</h3>
            </a>
        </li>
        <li class="lista">
            <a id="a1" class="amenu" href=" {{ route('group.index') }} ">
                <i class="imenu fas fa-users"></i>
                <h3 class="h3menu">Grupos</h3>
            </a>
        </li>
        <li class="lista">
            <a id="a1" class="amenu" href=" {{ route('user.dashboard') }} ">
                <i class="imenu fas fa-user-plus"></i>
                <h3 class="h3menu">Cadastrar</h3>
            </a>
        </li>
        <li class="lista">
            <a id="a1" class="amenu" href=" {{ route('moviment.application') }} ">
                <i class="imenu fas fa-coins"></i>
                <h3 class="h3menu">Investir</h3>
            </a>
        </li>
        <li class="lista">
            <a id="a1" class="amenu" href=" {{ route('moviment.getback') }} ">
                <i class="imenu fas fa-coins"></i>
                <h3 class="h3menu">Resgatar</h3>
            </a>
        </li>
        <li class="lista">
            <a id="a1" class="amenu" href=" {{ route('moviment.index') }} ">
                <i class="imenu fas fa-coins"></i>
                <h3 class="h3menu">Aplicações</h3>
            </a>
        </li>
        <li class="lista">
            <a id="a1" class="amenu" href=" {{ route('moviment.all') }} ">
                <i class="imenu fas fa-receipt"></i>
                <h3 class="h3menu">Extrato</h3>
            </a>
        </li>
    </ul>
    <ul class="lista" style="margin-top: 60px;">
        <li class="lista" style="">
            <a class="alogout" href="{{ route('logout') }}">
                <i class="fas fa-door-open ilogout"></i>
                <h3 class="h3logout" >Sair</h3>
            </a>
        </li>
    </ul>
</nav>