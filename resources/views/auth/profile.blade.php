@extends('layouts.app')

@section('content')
    <h2 class="">{{ Auth::user()->name }}</h2>
    <h2>{{ Auth::user()->email }}</h2>
   
@endsection
