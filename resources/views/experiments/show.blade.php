@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary d-block mb-3" href="{{ route('subject.show', $subject) }}">Back</a>
    
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
                            <label for="sati" class="col-sm-3 col-form-label">Hours</label>
                            <div class="col-sm-9">
                                <input id="sati" type="number" class="form-control" name="sati" min="0" max="23" autofocus>
                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="minuti" class="col-sm-3 col-form-label">Minutes</label>
                            <div class="col-sm-9">
                                <input id="minuti" type="number" class="form-control" name="minuti" min="0" max="59">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="komentar" class="col-form-label">Comment</label>
                    <textarea name="komentar" class="form-control" id="komentar" cols="30" rows="2"></textarea>
                </div>

                <input class="btn btn-primary" type="submit" value="Save">
            </form>
            <form action="{{route('task.comment.store', [$subject,$task])}}" method="post">
                @csrf
                <h3>Commetn for task</h3>

                <div class="form-group">
                    <label for="task_komentar" class="col-form-label">Commetn for task</label>
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
                        <th>Radio</th>
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
                <h3>There is no measurements for task {{$task->name}} </h3>
            @endif
                {{-- <p>{{$experiment->created_at->diffForHumans()}}</p>    --}}
        </div>
    </div>
</div>
@endsection
