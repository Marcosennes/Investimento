@extends('templates.master')

@section('conteudo-view')

<div class="col-md-12">
    <table class="table">
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
                        <form method="POST" accept-charset="UTF-8" action=" {{ route('instituition.destroy', ['id'=> $inst->id]) }} ">
                            {!! csrf_field() !!}
                            <input name="_method" type="hidden" value="DELETE">
                            @if( $user_permission == "app.admin" )
                                <div id="edit" style="display: show;">
                                    <button class="btn btn-1" type="submit">Remove</button>
                                </div>    
                            @endif
                        </form>
                    <a href="{{ route('instituition.show',          $inst->id) }}">Detalhes</a>
                    <a href="{{ route('instituition.product.index', $inst->id) }}">produtos</a>
                    @if( $user_permission == "app.admin" )
                        <div id="edit" style="display: show;">
                            <a href="{{ route('instituition.edit',  $inst->id) }}">editar</a>
                        </div>
                    @endif    
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection