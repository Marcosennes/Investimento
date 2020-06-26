@extends('templates.master')

@section('conteudo-view')
<div class="offset-lg-2 col-12 col-md-8 d-flex flex-column" style="background-color: white;">
    <form method="post" action="{{ route('moviment.search') }}">
    {!! csrf_field() !!}
        <h3 class="mt-3">Filtro:</h3>
        <label for="products">
            <input  type="text" class="form-control" name="product_name" aria-describedby="product" placeholder="produto">
        </label>
        <label for="groups">
            <input  type="text" class="form-control" name="group_name" aria-describedby="group" placeholder="grupo">
        </label>
        <button type="submit" style="width: 226px;" class="btn btn-1">Filtrar</button>
    </form>
    <table class="table" style="background-color: white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Dia</th>        
                <th scope="col">Hora</th>        
                <th scope="col">Tipo</th>        
                <th scope="col">Produto</th>        
                <th scope="col">Grupo</th>        
                <th scope="col">Valor investido</th>    
            </tr>        
        </thead>
        <tbody>
            @foreach ($moviment_list as $moviment)
                <tr>
                    <th scope="row">    {{ $moviment->created_at->format("d/m/Y")}}                 </th>
                    <th scope="row">    {{ $moviment->created_at->format("H:i")}}                 </th>
                    <td>                {{ $moviment->type == 1 ? "Aplicação" : "Resgate"}}               </td>
                    <td>                {{ $moviment->product_name}}               </td>
                    <td>                {{ $moviment->group_name}}               </td>
                    <td>             R$ {{ $moviment->value }}        </td>
    
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (isset($dataForm))
    <!-- Execução com filtro -->
        {{ $moviment_list->appends($dataForm)->links() }}
    @else
    <!-- Execução sem filtro -->
        {{ $moviment_list->links() }}
    @endif
</div>

@endsection