@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-2xl font-bold mb-4">
        បញ្ចូលពិន្ទុសិស្ស {{ $student->user->name ?? $student->name ?? 'សិស្សមិនបានកំណត់' }}
    </h1>

    <p class="text-gray-600 mb-6">ថ្នាក់: {{ $student->grade }}</p>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @php
        $subject = $student->latestSubject;
    @endphp

    <form action="{{ route('subject.store', $student->id) }}" method="POST">
        @csrf
        <table class="min-w-full border text-left mb-4 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ឈ្មោះសិស្ស</th>
                    <th class="px-4 py-2 border">គណិតវិទ្យា</th>
                    <th class="px-4 py-2 border">ភាសាខ្មែរ</th>
                    <th class="px-4 py-2 border">ភាសាអង់គ្លេស</th>
                    <th class="px-4 py-2 border">ប្រវត្តិសាស្ត្រ</th>
                    <th class="px-4 py-2 border">ភូមិសាស្ត្រ</th>
                    <th class="px-4 py-2 border">គីមីវិទ្យា</th>
                    <th class="px-4 py-2 border">រូបវិទ្យា</th>
                    <th class="px-4 py-2 border">ជីវវិទ្យា</th>
                    <th class="px-4 py-2 border">សីលធម៌</th>
                    <th class="px-4 py-2 border">កីឡា</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-4 py-2 border font-semibold">{{ $student->user->name ?? 'មិនមាន' }}</td>
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
                    <td class="px-4 py-2 border">
                        <input type="number" name="chemistry" value="{{ old('chemistry', $subject->chemistry ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="physics" value="{{ old('physics', $subject->physics ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="biology" value="{{ old('biology', $subject->biology ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="ethics" value="{{ old('ethics', $subject->ethics ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                    <td class="px-4 py-2 border">
                        <input type="number" name="sports" value="{{ old('sports', $subject->sports ?? '') }}" min="0" max="100" class="w-full border rounded px-2 py-1">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">រក្សាទុកពិន្ទុ</button>
            <a href="{{ route('students.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← ត្រលប់ក្រោយ</a>
        </div>
    </form>
</div>
@endsection
