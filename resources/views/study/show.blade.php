@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-sm-10">
            <h2 class="flex-grow-1">Study name: {{$study->name}}</h2>
        </div>
        <div class="col-sm-2">
            @can('admin')
            <a class="btn btn-outline-primary" href="{{route('study.edit', $study)}}">Edit study</a>
            @endcan
        </div>
    </div>
           
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <p class="m-0 p-1">Tasks</p> 
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($study->tasks as $task)
                        <li class="list-group-item">{{$task->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-white bg-dark d-flex">
                    <p class="m-0 p-1">Groups</p> 
                    @if(request('group'))
                    <a href="{{ route('study.show', $study) }}" class="btn btn-danger btn-sm ml-auto">X</a>
                    @endif
                </div>

                <ul class="list-group list-group--group list-group-flush">
                    @foreach ($study->groups as $group)
                        <li class="list-group-item p-0">
                            <a class="d-flex p-3 {{request()->query('group') == $group->name ? 'active-group' : ''}}" href="/study/{{$study->id}}?group={{urlencode($group->name)}}">{{$group->name}}<span class="badge badge-pill badge-info p-2 ml-auto">{{$group->subjects->count()}}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @if(count($subjects))
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-md-center mb-3">Study subjects</h2>
            <div class="table table1 table-responsive">
                <a class="table-row table-row-headig">
                    <div class="table-cell">Id</div>
                    <div class="table-cell">First name</div>
                    <div class="table-cell">Last name</div>
                    <div class="table-cell">Middle name</div>
                    <div class="table-cell">Date of birth</div>
                    <div class="table-cell">Gender</div>
                </a>
                @foreach ($subjects as $subject)
                <a class="table-row table-row-body" href="{{route('subject.show', $subject)}}">
                    <div class="table-cell">{{$subject->id}}</div>
                    <div class="table-cell">{{$subject->formattedName}}</div>
                    <div class="table-cell">{{$subject->prezime}}</div>
                    <div class="table-cell">{{$subject->srednje}}</div>
                    <div class="table-cell">{{$subject->rodjen->toFormattedDateString()}}</div>
                    <div class="table-cell">{{$subject->pol == 'm' ? 'male' : 'female'}}</div>
                </a>
                @endforeach
            </div>    
        </div>
    </div>
    @else
        <h3>No subjects for {{$study->name}} study</h3>
    @endif
</div>
@endsection


