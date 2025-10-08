@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="font-bold">Student Manage</h1>
</div>

<div class="max-w-4xl">
    <a href="{{ route('students.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Student</a>

    <table class="min-w-full mt-4 border border-gray-300 bg-white rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border">Student ID</th>
                <th class="py-2 px-4 border">Name</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Grade</th>
                <th class="py-2 px-4 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="border px-4 py-2">{{ $student->id }}</td>
                    <td class="border px-4 py-2">{{ $student->user->name }}</td>
                    <td class="border px-4 py-2">{{ $student->user->email }}</td>
                    <td class="border px-4 py-2">{{ $student->grade }}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('score.index') }}" class="text-blue-600 hover:underline">Add Score</a> |
                        <a href="{{ route('students.edit', $student) }}" class="text-blue-600 hover:underline">Edit</a> |
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection