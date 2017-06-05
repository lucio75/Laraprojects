@extends('template.default')
@section('title',$title)

@section('content')
<h1>
    With Blade
    {{$title}}
</h1>

        @if($staffb)
            <ul>
            @foreach ($staffb as $person)
                <li style="{{$loop->first ?'color:red':''}}"> {{$loop->remaining}} {{$loop->last}} {{$person['name']}} {{$person['lastname']}}</li>
            @endforeach
            </ul>
            @else
            <p>No Staff</p>
        @endif
    <ul>
        @forelse($staffb as $person)
            <li> {{$person['name']}} {{$person['lastname']}}</li>
        @empty
            <li>No Staff</li>
        @endforelse
    </ul>
<h2>Staff for</h2>
    @for($i=0;$i < count($staffb); $i++)
        {{ $staffb [$i]['name']}}<br/>
    @endfor
<h2>Staff While</h2>
    @while($person = array_pop($staffb))
        {{$person['name']}}<br/>
    @endwhile
    @endsection