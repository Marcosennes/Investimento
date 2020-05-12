@extends('templates.master')

@section('conteudo-view')

<div class="col-md-6">
    <h3>Cadastrar nova instituição</h3>
    <form method="post" action=" {{ route('instituition.store') }} ">
        {!! csrf_field() !!}
        <label for="registerInstituition">
            <input type="text" class="form-control" name="name" placeholder="Nome da Instituição">
        </label>
        <button class="btn btn-1" type="submit">Cadastrar</button>
    </form> 
</div>

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
                            <button class="btn btn-1" type="submit">Remove</button>
                        </form>
                    <a href="{{ route('instituition.show', $inst->id) }}">Detalhes</a>
                    <a href="{{ route('instituition.edit', $inst->id) }}">editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection