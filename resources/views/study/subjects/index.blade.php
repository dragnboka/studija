@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-4 font-weight-bold">Add subject to study</h2>
    
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Middle name</th>
                <th>Date of birth</th>
                <th>Gender</th>
                <th>Add</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
            <tr>
                <td>{{$subject->id}}</td>
                <td>{{$subject->formattedName}}</a></td>
                <td>{{$subject->prezime}}</td>
                <td>{{$subject->srednje}}</td>
                <td>{{$subject->rodjen->toFormattedDateString()}}</td>
                <td>{{$subject->pol == 'm' ? 'muski' : 'zenski'}}</td>
                <td>
                    <form action="{{ route('add.subject.to.study', [$study->name,$group->name, $subject]) }}">
                        <button class="btn btn-primary" type="submit">Add</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection