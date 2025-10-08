@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-2xl font-bold mb-4">Add Score for {{ $student->name }}</h1>

    <p class="text-gray-600 mb-6">You can add or view scores for this student.</p>

    <div class="border rounded-lg p-6 bg-white shadow">
        <p>Student ID: {{ $student->id }}</p>
        <p>Grade: {{ $student->grade }}</p>

        <div class="mt-6">
            <a href="{{ route('student.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Back</a>
        </div>
    </div>
</div>
@endsection
