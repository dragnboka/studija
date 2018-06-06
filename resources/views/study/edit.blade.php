@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                        aria-selected="true">Change current info</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                        aria-selected="false">Create new tasks and groups</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form class="mt-3" action="{{route('study.update', $study)}}" method="POST">
                        @method('PUT') @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <h3>Study name</h3>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">{{ __('Ime') }}</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $study->name) }}"    autofocus >
            
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h3>Tasks</h3>
                                @foreach ($study->tasks as $i => $task)
                                <div class="form-group">
                                    <input type="text" class="form-control{{ $errors->has("tasks.$i") ? ' is-invalid' : '' }}" name="tasks[]" value="{{ old("tasks.$i", $task->name) }}" id="task-{{$task->id}}">
                                
                                    @if ($errors->has("tasks.$i"))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first("tasks.$i") }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>

                            <div class="col-md-4">
                                <h3>Groups</h3>
                                @foreach ($study->groups as $i => $group)
                                    <div class="form-group">
                                        <input type="text" class="form-control{{ $errors->has("groups.$i") ? ' is-invalid' : '' }}" name="groups[]" value="{{ old("groups.$i", $group->name) }}" id="group-{{$group->id}}">
                                        
                                        @if ($errors->has("groups.$i"))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first("groups.$i") }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <div class="col-md-6 mx-auto d-flex justify-content-center">
                                <button class="btn btn-primary mr-3" type="submit">Edit</button>
                                <a class="btn btn-primary" href="{{ route('study.show', $study) }}">Cancel</a>
                            </div>
                        </div>
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
