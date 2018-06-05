@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-4 font-weight-bold">Create new study</h2>
    
    <study csrf={{ csrf_token() }}></study>
@endsection