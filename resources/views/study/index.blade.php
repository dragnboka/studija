@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 order-md-12">
            <a class="btn btn-primary mb-4" href="{{route('study.create')}}">Create new study</a>
        </div>
        
        @if(count($studies))
        <div class="col-md-10 order-md-1">
            <h2 class="mb-3 text-center">All studies</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>Participants count</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studies as $study)
                    <tr>
                        <td>{{$study->id}}</td>
                        <td><a href="{{route('study.show', $study)}}">{{$study->name}}</a></td>
                        <td>{{$study->created_at->toFormattedDateString()}}</td>
                        <td class="text-center">{{$study->subjects_count}}</td>
                        <td><a href="{{route('exels', $study)}}">exel</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>  
        @else
            <div class="col-md-10 order-md-1">
                <h2>Trenutno ne postoji ni jedna studija</h2>
            </div>
        @endif
         
    </div>
</div>
@endsection
