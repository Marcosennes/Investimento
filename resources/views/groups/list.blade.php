<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>        
            <th scope="col">Nome do grupo</th>        
            <th scope="col">Investimento</th>        
            <th scope="col">Nome do responsável</th>        
            @if( $user_permission == "app.admin" )
                <th scope="col">Opções</th>             
            @endif
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
                    @if( $user_permission == "app.admin" )
                        @if($type_page == "index")
                            <form method="POST" action=" {{ route('group.destroy', ['id'=> $group->id]) }} "  accept-charset="UTF-8">
                                {!! csrf_field() !!}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-1" type="submit">Remove</button>
                            </form>
                        @endif
                        @if($type_page == "trash")
                            <a href="{{ route('group.restore', $group->id) }}" class="btn btn-1" type="submit">Restaurar</a>
                        @endif
                    @endif
                    @if( $user_permission == "app.admin" )
                        @if($type_page == "index")
                            <div id="edit" style="display: show;">
                                <a href="{{ route('group.show', $group->id) }}">Detalhes</a>
                                <a href="{{ route('group.edit', $group->id) }}">Editar</a>
                            </div>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
