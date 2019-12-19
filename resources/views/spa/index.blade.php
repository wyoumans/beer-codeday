@extends('layout.app')

@section('content')
<div>
    <router-view></router-view>
    <vue-progress-bar></vue-progress-bar>
</div>
@endsection
