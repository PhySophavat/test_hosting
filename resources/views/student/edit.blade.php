@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-xl font-bold mb-4">Edit Student</h1>

    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Student ID</label>
            <input type="text" name="id_student" value="{{ $student->id_student }}" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ $student->name }}" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ $student->email }}" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $student->phone }}" class="border rounded w-full px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('students.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
