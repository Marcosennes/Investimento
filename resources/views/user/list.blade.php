<div class="col-md-12" >
    <table class="table" style="background-color: white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>        
                <th scope="col">CPF</th>        
                <th scope="col">Nome</th>        
                <th scope="col">Telefone</th>        
                <th scope="col">Nascimento</th>        
                <th scope="col">E-mail</th>        
                <th scope="col">Status</th>        
                <th scope="col">Permissão</th>
                <th scope="col" style="text-align: center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user_list as $user)
                <tr>
                    <th scope="row"> {{ $user->id}} </th>
                    <td> {{ $user->formatted_cpf}}        </td>
                    <td> {{ $user->name}}       </td>
                    <td> {{ $user->formatted_phone}}      </td>
                    <td> {{ $user->formatted_birth}}      </td>
                    <td> {{ $user->email}}      </td>
                    <td> {{ $user->status}}     </td>
                    <td> {{ $user->permission}} </td>
                    <td> 
                        <div class="row">

                            @if($user_id == $user->id)
                                <a class="btn btn-primary" href=" {{ route('user.edit', $user->id) }} ">Editar</a>
                            @endif

                            @if( $user_permission == "app.admin" )
                                @if($user->permission == "app.user")
                                    <div id="tornar_admin" style=" margin-left: 5px;">
                                        <a class="btn btn-yellow" href=" {{ route('user.tornarAdmin', ['id' => $user->id]) }} ">Tornar Admin</a>
                                    </div>
                                @endif
                                @if($user->permission == "app.admin")
                                    <div id="tornar_admin" style=" margin-left: 5px;">
                                        <a class="btn btn-yellow" href=" {{ route('user.tornarAdmin', ['id' => $user->id]) }} ">Retirar Admin</a>
                                    </div>      
                                @endif
                                <!--
                                <div style=" margin-left: 5px;">
                                    <form method="POST" accept-charset="UTF-8" action=" {{ route('user.destroy', ['id'=> $user->id]) }} ">
                                        {!! csrf_field() !!}
                                        <input name="_method" type="hidden" value="DELETE">
                                            <div id="remove">
                                                <button class="btn btn-danger" type="submit">Remove</button>
                                            </div>
                                    </form>
                                </div>
                                -->
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>