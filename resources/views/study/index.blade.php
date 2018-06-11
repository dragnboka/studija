@extends('layouts.app')

@section('title','Studies')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 order-md-12">
            <a class="btn btn-primary mb-4" href="{{route('study.create')}}">Create new study</a>
        </div>
        
        @if(count($studies))
        <div class="col-md-10 order-md-1">
            <h2 class="mb-3 text-center">All studies</h2>

            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr class="text-center">
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
                        <td class="p-0 align-middle text-center">{{$study->id}}</td>
                        <td class="d-flex p-0 table-hover"><a class="p-3 flex-grow-1" href="{{route('study.show', $study)}}">{{$study->name}}</a></td>
                        <td class="p-0 align-middle text-center">{{$study->created_at->toFormattedDateString()}}</td>
                        <td class="text-center p-0 align-middle">{{$study->subjects_count}}</td>
                        <td class=" d-flex p-0 align-middle text-center table-hover">
                            @if($study->subjects_count)
                            <a class="p-3 flex-grow-1" href="{{route('exels', $study)}}">Study subjects</a>
                            @endif
                        </td>
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
