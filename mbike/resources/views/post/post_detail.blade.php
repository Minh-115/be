@extends('layouts.master')
@section('title')
<title>Home Page</title>
@endsection()

@section('css')
<link rel='stylesheet' href="{{asset('home/home.css')}}">	
@endsection()

@section('js')
<link rel='stylesheet' href="{{asset('home/home.js')}}">


@endsection()

@section('content')

<div class="container">

        
 <div class="">@include('components.sliderbar')</div>
<div class="col-md-9">
     {!!$posts->post_content!!}
     </div>
     
</div>

@endsection()