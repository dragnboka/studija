@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 mx-auto">
            <form action="{{route('subject.store', [$study,$group])}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="firstName" class="col-form-label">First name</label>
                    <input id="firstName" type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" autofocus >
        
                    @if ($errors->has('firstName'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('firstName') }}</strong>
                        </span>
                    @endif
                </div>
        
                <div class="form-group">
                    <label for="lastName" class="col-form-label">Last name</label>
                    <input id="lastName" type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName">
        
                    @if ($errors->has('lastName'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('lastName') }}</strong>
                        </span>
                    @endif
                </div>
        
                <div class="form-group">
                    <label for="middleName" class="col-form-label">Middle name</label>
                    <input id="middleName" type="text" class="form-control{{ $errors->has('middleName') ? ' is-invalid' : '' }}" name="middleName">
        
                    @if ($errors->has('middleName'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('middleName') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="date" class="col-form-label">Date of birth</label>
                    <input class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }} mb-2" type="date" id="date" name="dob">
    
                    @if ($errors->has('dob'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="mb-2">
                    <p class="mb-2">Gender</p>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input name="gender" class="custom-control-input" type="radio" id="male" value="m">
                        <label class="custom-control-label" for="male">
                            Male
                        </label>
                    </div>
        
                    <div class="custom-control custom-radio custom-control-inline">
                        <input name="gender" class="custom-control-input" type="radio" id="female" value="f">
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
                    <textarea class="form-control" id="komentar" rows="3" name="komentar"></textarea>
                </div>
        
                <button type="submit" class="btn btn-primary my-5">
                    Create
                </button>
                {{-- <a class="btn btn-primary ml-3" href="{{ route('subject.show', $subject) }}">Cancel</a> --}}
            </form>
        </div>
    </div>
    
</div>
@endsection