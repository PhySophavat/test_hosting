@extends('layouts.app')

@section('content')
<div class="max-w-md mt-10 bg-white p-6 ">
    <h1 class="text-xl font-bold mb-4">Add Teacher</h1>

<form action="{{ route('teacher.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-bold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Password</label>
            <input type="password" name="password" class="border p-2 w-full" required>
        </div>

       

        <div class="mb-4">
            <label class="block font-bold mb-1">Subject</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="border p-2 w-full" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
            Add Teacher
        </button>
    </form>

</div>
@endsection
