@extends('layouts.app')

@section('content')
    <h2 class="">{{ Auth::user()->name }}</h2>
@endsection
