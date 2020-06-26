<table class="table" style="background-color: white">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>        
            <th scope="col">Nome da instituição</th>        
            <th scope="col">Opções</th>        
        </tr>        
    </thead>
    <tbody>
        @foreach ($instituitions as $inst)
            <tr>
                <th scope="row">    {{ $inst->id}}          </th>
                <td>                {{ $inst->name}}        </td>
                <td>
                <div class="row">
                    @if( $user_permission == "app.admin" )
                        @if($type_page == "index")
                            <form method="POST" accept-charset="UTF-8" action=" {{ route('instituition.destroy', ['id'=> $inst->id]) }} ">
                                {!! csrf_field() !!}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Remove</button>
                            </form>
                        @endif
                        @if($type_page == "trash")
                            <a href="{{ route('instituition.restore', $inst->id) }}" class="btn btn-1" type="submit">Restaurar</a>
                        @endif
                    @endif
                    @if( $user_permission == "app.admin" )
                        @if($type_page == "index")
                            <a class="btn btn-1 ml-1"       href="{{ route('instituition.product.index', $inst->id) }}">Produtos</a>
                            <a class="btn btn-primary ml-1" href="{{ route('instituition.edit',  $inst->id) }}">Editar</a>
                        @endif
                    @endif
                </div>    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
