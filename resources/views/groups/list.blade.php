<table class="table" style="background-color: white">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>        
            <th scope="col">Nome do grupo</th>        
            <th scope="col">Investimento</th>        
            <th scope="col">Nome do responsável</th>        
            <th scope="col" style="text-align: center">Opções</th>             
        </tr>        
    </thead>
    <tbody>
        @foreach ($group_list as $group)
            <tr>

                <th scope="row">    {{ $group->id}}                 </th>
                <td>                {{ $group->name}} </td>
                <td>             R$ {{ number_format($group->total_value, 2, ',', '.')}}        </td>
                <td>                {{ $group->user->name}}         </td>
                <td> 
                    <div class="row">
                        @if( $user_permission == "app.admin" )
                            @if($type_page == "index")
                                <form method="POST" action=" {{ route('group.destroy', ['id'=> $group->id]) }} "  accept-charset="UTF-8">
                                    {!! csrf_field() !!}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Remove</button>
                                </form>
                            @endif
                            @if($type_page == "trash")
                                <a href="{{ route('group.restore', $group->id) }}" class="btn btn-1" type="submit">Restaurar</a>
                            @endif
                        @endif
                        <a class="btn btn-1 ml-1" href="{{ route('group.show', $group->id) }}">Detalhes</a>
                        @if( $user_permission == "app.admin" )
                            @if($type_page == "index")
                                <a class="btn btn-primary ml-1" href="{{ route('group.edit', $group->id) }}">Editar</a>
                            @endif
                        @endif
                    </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
