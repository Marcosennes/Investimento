@extends('templates.master')

@section('conteudo-view')
<div class="col-md-12">
    @include('moviment.list', ['product_list' => $product_list])
</div>

@endsection