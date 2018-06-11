@extends('layouts.app')

@section('title',"Edit $subject->fullName ")

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                    aria-selected="true">Change {{$subject->fullName}} info</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                    aria-selected="false">Dodaj Ispitanika novoj studiji</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="{{route('subject.update', $subject)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="firstName" class="col-form-label">First name</label>
                        <input id="firstName" type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ old('firstName', $subject->ime) }}"    autofocus >

                        @if ($errors->has('firstName'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('firstName') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="lastName" class="col-form-label">Last name</label>
                        <input id="lastName" type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ old('lastName', $subject->prezime) }}"    autofocus >

                        @if ($errors->has('lastName'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('lastName') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="middleName" class="col-form-label">Middle name</label>
                        <input id="middleName" type="text" class="form-control{{ $errors->has('middleName') ? ' is-invalid' : '' }}" name="middleName" value="{{ old('middleName', $subject->srednje) }}"    autofocus >

                        @if ($errors->has('middleName'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('middleName') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <p class="mb-2">Gender</p>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" class="custom-control-input" type="radio" id=male" value="m" {{$subject->pol ==='m' ? 'checked' : ' '}}>
                            <label class="custom-control-label" for=male">
                                Male
                            </label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input name="gender" class="custom-control-input" type="radio" id="female" value="f" {{$subject->pol ==='f' ? 'checked' : ' '}}>
                            <label class="custom-control-label" for="female">
                                Female
                            </label>
                        </div>

                        @if ($errors->has('gender'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="komentar">Comment</label>
                        <textarea class="form-control" id="komentar" rows="3" name="komentar">{{$subject->komentar}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary my-5">
                        Edit
                    </button>
                    <a class="btn btn-primary ml-3" href="{{ route('subject.show', $subject) }}">Cancel</a>
                </form>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                
                <update-subject :id={{$subject->id}}></update-subject>
                
            </div>            
        </div>    
    </div>
</div>
@endsection