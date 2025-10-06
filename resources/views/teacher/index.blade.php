@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class=" mb-4">Teacher Manage</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('teacher.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Teacher</a>

    <table class="min-w-full mt-4 border border-gray-300 bg-white rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                {{-- <th class="py-2 px-4 border">#</th> --}}
                <th class="py-2 px-4 border">Name</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                {{-- <td class="py-2 px-4 border">{{ $loop->iteration }}</td> --}}
                <td class="py-2 px-4 border">{{ $teacher->name }}</td>
                <td class="py-2 px-4 border">{{ $teacher->email }}</td>
                <td class="py-2 px-4 border text-center">
                    <a href="{{ route('teacher.edit', $teacher) }}" class="text-blue-600 hover:underline">Edit</a> |
                    <form action="{{ route('teacher.destroy', $teacher) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this teacher?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
