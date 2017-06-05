@extends('template.default')
@section('title',$title)

@section('content')
    <h1>
        With Blade
        {{$title}}
    </h1>
    @component('components.card',
    [
        'img_title'=>'Image blog',
        'img_url'=>'http://lorempixel.com/400/200'
    ]
    )
    <p>This is a beautiful image i took in New York</p>
    @endcomponent

    @component('components.card')

        @slot('img_url','http://lorempixel.com/400/200')
        @slot('img_title','Image Blog 2')
    <p>This is a beautiful image i took in New York</p>
    @endcomponent
@endsection

@include('components.card')

@section('footer')
    <script>
        alert('sei su blog')
    </script>
   @parent
@endsection