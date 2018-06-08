@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="row mb-3">
        <div class="col-sm-12">
            @can('admin')
            <div class="d-flex justify-content-around">
            <a class="btn btn-success-my w-25" href="{{route('subject.edit', $subject)}}">Edit</a>
            <button type="button" class="btn btn-outline-danger w-25" data-toggle="modal" data-target="#exampleModal">
                    Delete {{$subject->ime}}
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete subject {{$subject->ime}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <form action="{{route('subject.destroy', $subject)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Yes</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            @endcan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <table class="table table-hover">
                <tr class="table-success">
                    <th colspan="2">{{$subject->fullName}} info</th>
                </tr>
                <tr>
                    <td>First name</td>
                    <td>{{$subject->ime}}</td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td>{{$subject->prezime}}</td>
                </tr>
                <tr>
                    <td>Middle name</td>
                    <td>{{$subject->srednje}}</td>
                </tr>
                <tr>
                    <td>Date of birth</td>
                    <td>{{$subject->rodjen->format('d,m,Y')}}</td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td>{{$subject->age}}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{$subject->formattedPol}}</td>
                </tr>
                <tr>
                    <td>Subject comment</td>
                    <td>{{$subject->komentar}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            @if(count($studyGroups))
            <table class="table table-hover">
                <tr class="table-success">
                    <th colspan="2">Studies for {{$subject->fullName}}</th>
                </tr>
                <tr>
                    <td>Study name</td>
                    <td>Group</td>
                </tr>
                @foreach ($studyGroups as $study)
                <tr>
                    <td>
                        <p>{{$study->studyName}}</p>
                        <a class="btn btn-primary" href="{{route('subject.experiments', [$study->id,$subject])}}">Export subject Experiments</a>
                    </td>
                    <td>{{$study->groupName}}</td>
                </tr>
                @endforeach
            </table>
            @else 
                <h3>Subject is not in any study</h3>   
            @endif
        </div>
    </div>

    @if(count($studyGroups))
        <div class="row mb-5">
            <div class="col-md-12">
                <h2 class="text-center">Choose task for new measuer</h2>
                <div id="accordion">
                    @foreach ($subject->studies as $study)
                    <div class="card">
                        <div class="card-header p-0" id="heading{{$study->id}}">
                        <h5 class="mb-0 d-flex">
                            <button class="btn flex-grow-1 p-3" data-toggle="collapse" data-target="#{{$study->id}}" aria-expanded="true" aria-controls="collapseOne">
                                {{$study->name}}
                            </button>
                        </h5>
                        </div>
                    
                        <div id="{{$study->id}}" class="collapse" aria-labelledby="heading{{$study->id}}" data-parent="#accordion">
                            <div class="card-body p-0">
                                <ul class="list-group list-group--task">
                                    @foreach ($study->tasks as $task)
                                    <li class="list-group-item p-0 text-center d-flex">
                                        <a class="flex-grow-1 p-3" href="{{route('experiment.show', [$subject,$task])}}">{{$task->name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if(count($experiments))
                <h2 class="my-3 text-center">All measurements for {{$subject->ime}}</h2>
                <div class="btn-group mb-4">
                    <button type="button" class="btn btn-outline-primary btn-square dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- {{request()->input($key) ?? $key}} --}}
                        Tasks
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($subject->studies as $study)
                        @foreach ($study->tasks as $task)
                            <a class="dropdown-item" href="/subject/{{$subject->id}}?task={{$task->name}}">{{$task->name}}</a>
                        @endforeach
                        @endforeach
                    </div> 
                </div>
                {{-- @foreach ($experiments->task as $task)
                    {{$task->name}}
                @endforeach --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Comment</th>
                            <th>Radio</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($experiments as $experiment)
                        <tr>
                            <td>{{$experiment->time($experiment->vreme)}}</td>
                            <td>{{$experiment->komentar}}</td>
                            <td>{{$experiment->radio}}</td>
                            <td>{{$experiment->task->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $experiments->links() }}
                @else
                    <h3 class="text-center">No measurements for {{$subject->ime}}</h3>
                @endif
            
            </div>
        </div>
    @endif
</div>
@endsection