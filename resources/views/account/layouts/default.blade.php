@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-2">
            @include('account.layouts.partials._navigation')
        </div>
        <div class="col-sm-10">
            @yield('account.content')
        </div>
    </div>
@endsection
