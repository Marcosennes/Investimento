@extends('templates.master')

@section('conteudo-view')

@if( $user_permission == "app.admin" )
    <div class="col-12 col-lg-2 row d-flex flex-colum n pb-3" id="lixeira">
        @if($type_page == "index")
            <a href="{{ route('instituition.trash') }}" class="btn btn-1" type="submit">Lixeira</a>
        @endif
        @if($type_page == "trash")
            <a href="{{ route('instituition.index') }}" class="btn btn-1" type="submit">Grupos</a>
        @endif
    </div>
@endif

@include('instituitions.list', [    'instituition_list' => $instituitions, 
                                    'user_permission'   => $user_permission,
                                    'type_page'         => $type_page])

@endsection