@extends('templates.master')

@section('conteudo-view')

@if($user_permission == 'app.admin')
<div class="offset-lg-2 col-12 col-lg-8" style="background-color: white">
    <div class="row d-flex flex-column">
        <form method="post" action=" {{ route('instituition.product.store', ['id' => $instituition->id]) }} ">
            {!! csrf_field() !!}
            <div class="ml-3 mr-3 d-flex flex-column">
                <div class="mt-3">
                    <h2 style="color: black">Novo Produto</h2>
                </div>
                <label for="product-name">
                    <input type="text" class="form-control" name="name" placeholder="Nome do produto">
                </label>
                <label for="description">
                    <input type="text" class="form-control" name="description" placeholder="Descrição do produto">
                </label>
                <label for="indexador">
                    <input type="text" class="form-control" name="index" placeholder="index">
                </label>
                <label for="taxa-de-juros">
                    <input type="text" class="form-control" name="interest_rate" placeholder="taxa de juros (%)">
                </label>
                <br>
                <button class="btn btn-black mb-2" type="submit">Cadastrar</button>
            </div>
        </form> 
    </div>
</div>
@endif
<div class="col-md-12 mt-4">
    <table class="table" style="background-color: white">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>        
                <th scope="col">Nome</th>        
                <th scope="col">indexador</th>        
                <th scope="col">Taxa</th>        
                <th scope="col">Descrição</th>      
                @if($user_permission == 'app.admin')  
                <th scope="col">Opções</th>        
                @endif
            </tr>        
        </thead>
        <tbody>
            @forelse ($instituition->products as $product)
                <tr>
                    <th scope="row">    {{ $product->id}}               </th>
                    <td>                {{ $product->name}}             </td>
                    <td>                {{ $product->index}}            </td>
                    <td>                {{ $product->interest_rate}}    </td>
                    <td>                {{ $product->description}}      </td>
                    @if($user_permission == 'app.admin')
                    <td> 
                        <form method="POST" accept-charset="UTF-8" action=" {{ route('instituition.product.destroy', ['instituition_id' => $instituition->id,'product_id'=> $product->id]) }} ">
                            {!! csrf_field() !!}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-1" type="submit">Remove</button>
                        </form>
                    <a href="{{ route('instituition.edit',          $product->id) }}">editar</a>
                    </td>
                    @endif
                </tr>
            @empty
            <tr>
                <td>Nada Cadastrado</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection