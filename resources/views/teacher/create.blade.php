@extends('layouts.app')

@section('content')
<div class="max-w-md mt-10 bg-white p-6 ">
    <h1 class="text-xl font-bold mb-4">Add Teacher</h1>

<form action="{{ route('teacher.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" class="border rounded w-full px-3 py-2" required>
    </div>
    <div class="mb-4">
        <label>Email</label>
        <input type="email" name="email" class="border rounded w-full px-3 py-2" required>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
</form>


</div>
@endsection
