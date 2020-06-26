@extends('templates.master')

@section('conteudo-view')
<div class="col-12">
    @if( $user_permission == "app.admin" )
        <div class="col-12 col-lg-2 row d-flex flex-colum pb-3" id="lixeira">
            @if($type_page == "index")
                <a href="{{ route('instituition.trash') }}" class="btn btn-black" type="submit">Lixeira</a>
            @endif
            @if($type_page == "trash")
                <a href="{{ route('instituition.index') }}" class="btn btn-black" type="submit">Grupos</a>
            @endif
        </div>
    @endif

    @include('instituitions.list', [    'instituition_list' => $instituitions, 
                                        'user_permission'   => $user_permission,
                                        'type_page'         => $type_page])
</div>
@endsection