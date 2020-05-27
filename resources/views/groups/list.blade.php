<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>        
            <th scope="col">Nome do grupo</th>        
            <th scope="col">Nome da instituição</th>        
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
                <td>                {{ $group->instituition->name}} </td>
                <td>             R$ {{ number_format($group->total_value, 2, ',', '.')}}        </td>
                <td>                {{ $group->user->name}}         </td>
                <td> 
                    <form method="POST" accept-charset="UTF-8" action=" {{ route('group.destroy', ['id'=> $group->id]) }} ">
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="DELETE">
                        @if( $user_permission == "app.admin" )
                            <div id="remove" style="display: show;">
                                <button class="btn btn-1" type="submit">Remove</button>
                            </div>
                        @endif
                    </form>
                    @if( $user_permission == "app.admin" )
                    <div id="edit" style="display: show;">
                        <a href="{{ route('group.show', $group->id) }}">Detalhes</a>
                        <a href="{{ route('group.edit', $group->id) }}">Editar</a>
                    </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
