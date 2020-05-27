@extends('templates.master')

@section('conteudo-view')
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6" style="float: ">
    </div>
</div>
<div class="col-md-12">

    @include('groups.list', ['group_list' => $groups, 'user_permission' => $user_permission])


</div>

@endsection