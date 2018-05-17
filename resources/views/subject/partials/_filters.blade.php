@foreach ($mappings as $key => $map)
    <div class="btn-group mb-4">
            <button type="button" class="btn btn-outline-primary btn-square dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- {{request()->input($key) ?? $key}} --}}
                {{$key}}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($map as $value => $name)
                    <a class="dropdown-item" href="{{route('subject.index', array_merge(request()->query(), [$key => $value, 'page' => 1]))}}">{{$name}}</a>
                @endforeach
            </div> 
            @if(request($key))
                <a href="{{ route('subject.index', array_except(request()->query(), [$key, 'page'])) }}" class="btn btn-danger">X</a>
            @endif 
    </div>
    {{-- @include('subject.partials._filter_list', compact('key', 'map')) --}}
@endforeach
