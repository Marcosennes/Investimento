<div class="col-md-12">
    <table class="table">
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
                <th scope="col">Menu</th>
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
                        <form method="POST" accept-charset="UTF-8" action=" {{ route('user.destroy', ['id'=> $user->id]) }} ">
                            {!! csrf_field() !!}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-1" type="submit">Remove</button>
                        </form>
                        <a href=" {{ route('user.edit', $user->id) }} ">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>