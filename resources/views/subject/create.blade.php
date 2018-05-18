@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="/subject">
        @csrf
        <subject></subject>
    </form>
</div>
@endsection