@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="font-bold"> Wellcome to Dashboard</h1>
</div>

   <p>Welcome, {{ Auth::user()->name }}</p>
@endsection