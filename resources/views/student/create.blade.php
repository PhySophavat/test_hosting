@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-xl font-bold mb-4">Add Student</h1>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label>Student ID</label>
            <input type="text" name="id_student" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Phone</label>
            <input type="text" name="phone" class="border rounded w-full px-3 py-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
        <a href="{{ route('students.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
