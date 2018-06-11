@extends('layouts.app')

@section('title',"$subject->ime experiments for $task->name")

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-sm-3 mb-1">
            <div class="d-flex align-items-center mr-1">
                <a class="btn btn-primary m-1" href="{{ route('subject.show', $subject) }}"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                    Back to profile</a>
            </div>

        </div>
        <div class="col-sm-9 mb-1">
            @if (count($tasks))
            <h2 class="text-center">Other tasks for study {{$task->study->name}} </h2>
            <div class="d-flex justify-content-between flex-wrap">
                @foreach ($tasks as $t)
                <a class="btn btn-primary m-1 flex-grow-1" href="{{route('experiment.show', [$subject,$t])}}">
                    {{$t->name}}
                </a>
                @endforeach
            </div>
            @else

            @endif
        </div>
    </div>
    
    <h2 class="mb-4">Task: {{$task->name}} 
        @if ($komentar)
        ({{$komentar->pivot->komentar}})</span>
        @endif
    </h2>
    <div class="row">
        <div class="col-lg-5 order-lg-12 mb-4">
            <form class="mb-4" action="{{route('experiment.store', [$subject,$task])}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="sati" class="col-sm-3 col-form-label">Hour</label>
                            <div class="col-sm-9">
                                <input id="sati" type="number" class="form-control {{ $errors->has('hour') ? ' is-invalid' : '' }}" name="hour" min="0" max="23" autofocus required>
                            </div>
                            @if($errors->has('hour'))
                                <p class="text-danger mt-2 ml-3">{{ $errors->first('hour') }}</p>
                            @endif
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="minuti" class="col-sm-3 col-form-label">Minute</label>
                            <div class="col-sm-9">
                                <input id="minuti" type="number" class="form-control{{ $errors->has('minute') ? ' is-invalid' : '' }}" name="minute" min="0" max="59" required>
                            </div>
                            @if($errors->has('minute'))
                                <p class="text-danger mt-2 ml-3">{{ $errors->first('minute') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="comment" class="col-form-label">Comment</label>
                    <textarea name="comment" class="form-control" id="comment" cols="30" rows="2"></textarea>
                </div>

                <input class="btn btn-primary" type="submit" value="Save">
            </form>
            <form action="{{route('task.comment.store', [$subject,$task])}}" method="post">
                @csrf
                <h3>Comment for task</h3>

                <div class="form-group">
                    <textarea name="task_komentar" class="form-control" id="task_komentar" cols="30" rows="3"></textarea>
                </div>

                <input class="btn btn-primary" type="submit" value="Save">
            </form>
        </div>

        <div class="col-lg-7 order-lg-1">
            @if (count($experiments))    
            <table class="table">
                <thead>
                    <tr class="table-success">
                        <th>#</th>
                        <th>Time</th>
                        <th>Comment</th>
                        <th>Done by</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experiments as $experiment)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$experiment->time($experiment->vreme)}}</td>
                        <td>{{$experiment->komentar}}</td>
                        <td>{{$experiment->radio}}</td>
                    </tr>   
                    @endforeach
                </tbody> 
            </table>
            @else
                <h3>There are no experiments for task {{$task->name}} </h3>
            @endif
                {{-- <p>{{$experiment->created_at->diffForHumans()}}</p>    --}}
        </div>
    </div>
</div>
@endsection
