@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="font-bold"> Wellcome to Dashboard</h1>
</div>

   <p>Welcome, {{ Auth::user()->name }}</p>
  <div class=" mt-10">
   <h1 class="text-2xl font-bold text-gray-800">Total Users: {{ $users }}</h1>
   <h1 class="text-2xl font-bold text-blue-600 mt-4">Total Students: {{ $students }}</h1>
   <h1 class="text-2xl font-bold text-green-600 mt-4">Total Teachers: {{ $teachers }}</h1>
</div>

@endsection