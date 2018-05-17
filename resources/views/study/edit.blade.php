@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                        aria-selected="true">Promeni Postojece Informacije</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                        aria-selected="false">Kreiraj nove taskove i grupe</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form class="mt-3" action="{{route('study.update', $study)}}" method="POST">
                        @method('PUT') @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Ime studije</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{$study->name}}" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-4">
                                @foreach ($study->tasks as $task)
                                <div class="form-group">
                                    <label for="task-{{$task->id}}">{{$task->id}} Ime taska</label>
                                    <input type="text" class="form-control" name="tasks[]" value="{{$task->name}}" id="task-{{$task->id}}">
                                </div>
                                @endforeach
                            </div>

                            <div class="col-md-4">
                                @foreach ($study->groups as $group)
                                <div class="form-group">
                                    <label for="group-{{$group->id}}">{{$group->id}} Ime groupa</label>
                                    <input type="text" class="form-control" name="groups[]" value="{{$group->name}}" id="group-{{$group->id}}">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Edit</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <update-study :study-id={{$study->id}}></update-study>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
