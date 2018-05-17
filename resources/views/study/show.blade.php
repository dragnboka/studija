@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-sm-10">
            <h2 class="flex-grow-1">{{$study->name}}</h2>
        </div>
        <div class="col-sm-2">
            @can('admin')
            <a class="btn btn-outline-primary" href="{{route('study.edit', $study)}}">Edit</a>
            @endcan
        </div>
    </div>
           
    <h2 class="text-md-center mb-3">All tasks</h2>
    <div class="row">
        @foreach ($study->tasks->chunk(2) as $tasks)
            @foreach ($tasks as $task)
            <div class="col-md-6">
                <div class="card mb-3">
                    <h5 class="card-header">{{$task->name}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{$task->comment}}</p>
                        <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#task-{{$task->id}}" aria-expanded="false" aria-controls="collapseExample">
                            Upisi/promeni
                        </button>
                        <div class="collapse mt-3" id="task-{{$task->id}}">
                            <form action="{{route('task.store', $task)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" rows="3"name="comment" placeholder="Unesi Komentar"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Unesi Komentar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
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


