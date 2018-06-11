@extends('account.layouts.default')

@section('title',"Add admins")

@section('account.content')
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Make an admin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->ime}}</td>
                        <td>{{$user->prezime}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form action="{{ route('admin.update', $user) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-primary" type="submit">+</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
