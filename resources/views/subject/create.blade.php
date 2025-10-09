@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-2xl font-bold mb-4">
        Add Scores for {{ $student->user->name ?? $student->name ?? 'Unknown Student' }}
    </h1>

    <p class="text-gray-600 mb-6">Grade: {{ $student->grade }}</p>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @php
        // Get the latest score (or null if not exists)
        $subject = $student->latestSubject;
    @endphp

    <form action="{{ route('subject.create', $student->id) }}" method="POST">
        @csrf
        <table class="min-w-full border text-left mb-4 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Student Name</th>
                    <th class="px-4 py-2 border">Math</th>
                    <th class="px-4 py-2 border">Khmer</th>
                    <th class="px-4 py-2 border">English</th>
                    <th class="px-4 py-2 border">History</th>
                    <th class="px-4 py-2 border">Geography</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-4 py-2 border font-semibold">{{ $student->user->name ?? 'Unknown' }}</td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="math" value="{{ old('math', $subject->math ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="khmer" value="{{ old('khmer', $subject->khmer ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="english" value="{{ old('english', $subject->english ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="history" value="{{ old('history', $subject->history ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="geography" value="{{ old('geography', $subject->geography ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Save Scores</button>
            <a href="{{ route('students.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Back</a>
        </div>
    </form>
</div>
@endsection
