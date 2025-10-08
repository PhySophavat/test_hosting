@extends('layouts.app')

@section('content')
<div class="max-w-md mt-10 bg-white p-6">
    <h1 class="text-xl font-bold mb-4">Add Student</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-bold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full" required>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full" required>
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-1">Password</label>
            <input type="password" name="password" class="border p-2 w-full" required>
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-1">Grade</label>
            <input type="text" name="grade" value="{{ old('grade') }}" class="border p-2 w-full" required>
            @error('grade') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
            Add Student
        </button>
    </form>
</div>
@endsection