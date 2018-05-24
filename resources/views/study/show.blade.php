@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-sm-10">
            <h2 class="flex-grow-1">Naziv Studije: {{$study->name}}</h2>
        </div>
        <div class="col-sm-2">
            @can('admin')
            <a class="btn btn-outline-primary" href="{{route('study.edit', $study)}}">Edit</a>
            @endcan
        </div>
    </div>
           
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    Taskovi
                </div>

                <ul class="list-group list-group-flush text-white">
                    @foreach ($study->tasks as $task)
                        <li class="list-group-item bg-info">{{$task->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    Grupe
                </div>

                <ul class="list-group list-group-flush text-white">
                    @foreach ($study->groups as $group)
                        <li class="list-group-item bg-info">{{$group->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-md-center mb-3">Ucesnici u studiji</h2>
            <div class="table table1 table-responsive">
                <a class="table-row table-row-headig">
                    <div class="table-cell">Id</div>
                    <div class="table-cell">Ime</div>
                    <div class="table-cell">Prezime</div>
                    <div class="table-cell">Srednje ime</div>
                    <div class="table-cell">Rodjen/a</div>
                    <div class="table-cell">Pol</div>
                </a>
                @foreach ($study->subjects as $subject)
                <a class="table-row table-row-body" href="{{route('subject.show', $subject)}}">
                    <div class="table-cell">{{$subject->id}}</div>
                    <div class="table-cell">{{$subject->formattedName}}</div>
                    <div class="table-cell">{{$subject->prezime}}</div>
                    <div class="table-cell">{{$subject->srednje}}</div>
                    <div class="table-cell">{{$subject->rodjen->toFormattedDateString()}}</div>
                    <div class="table-cell">{{$subject->pol == 'm' ? 'muski' : 'zenski'}}</div>
                </a>
                @endforeach
            </div>    
        </div>
    </div>            
</div>
@endsection


