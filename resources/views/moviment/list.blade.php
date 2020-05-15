<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>        
            <th scope="col">Produto</th>        
            <th scope="col">Nome da instituição</th>        
            <th scope="col">Valor investido</th>    
        </tr>        
    </thead>
    <tbody>
        @foreach ($product_list as $product)
            <tr>
                <th scope="row">    {{ $product->name}}                 </th>
                <td>                {{ $product->instituition->name}}               </td>
                <td>             R$ {{ $product->valueFromUser(Auth::user()) }}        </td>

            </tr>
        @endforeach
    </tbody>
</table>