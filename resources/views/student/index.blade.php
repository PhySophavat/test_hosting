@extends('layouts.app')

@section('content')
<div class="p-10">
    @if(Auth::user()->hasPermission('add-student'))
    <h1 class="text-3xl font-bold mb-6">Student Management</h1>

    <div class="max-w-5xl mx-auto">
        <!-- Add Student Button -->
        <div class="mb-4">
            <a href="{{ route('student.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add Student
            </a>
        </div>
    @endif
    
        <!-- Student Table -->
          @if (Auth::user()->hasPermission('add-student'))
                        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold border-b">Student ID</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Name</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Email</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Grade</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50 even:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $student->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $student->user->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $student->user->email ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $student->grade }}</td>
                            <td class="py-2 px-4 border-b space-x-2">
                          <a href="{{ route('subject.create', $student->id) }}" 
                                   class="text-blue-600 hover:underline font-medium">Add Score</a>
                       @if (Auth::user()->hasRole('admin'))
                                <a href="{{ route('students.edit', $student) }}" 
                                   class="text-green-600 hover:underline font-medium">Edit</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:underline font-medium" 
                                            onclick="return confirm('Delete this student?')">
                                        Delete
                                    </button>
                                </form>
                      @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> 
                    @endif
        {{-- <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold border-b">Student ID</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Name</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Email</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Grade</th>
                        <th class="py-3 px-4 text-left font-semibold border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="hover:bg-gray-50 even:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $student->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $student->user->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $student->user->email ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $student->grade }}</td>
                            <td class="py-2 px-4 border-b space-x-2">
                                <a href="{{ route('subject.create', $student->id) }}" 
                                   class="text-blue-600 hover:underline font-medium">Add Score</a>
                                <a href="{{ route('students.edit', $student) }}" 
                                   class="text-green-600 hover:underline font-medium">Edit</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:underline font-medium" 
                                            onclick="return confirm('Delete this student?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> --}}
    </div>
</div>
{{-- ///////////////////////// --}}
<div class="p-10">
    <h1 class="text-2xl font-bold mb-6">Student Scores</h1>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">ID</th>
                <th class="py-2 px-4 border-b text-left">Name</th>
                <th class="py-2 px-4 border-b text-left">Grade</th>
                <th class="py-2 px-4 border-b text-left">Math</th>
                <th class="py-2 px-4 border-b text-left">Khmer</th>
                <th class="py-2 px-4 border-b text-left">English</th>
                <th class="py-2 px-4 border-b text-left">History</th>
                <th class="py-2 px-4 border-b text-left">Geography</th>
                <th class="py-2 px-4 border-b text-left">Total</th>
                <th class="py-2 px-4 border-b text-left">Average</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                @php
                    $math = $student->subjects->sum('math');
                    $khmer = $student->subjects->sum('khmer');
                    $english = $student->subjects->sum('english');
                    $history = $student->subjects->sum('history');
                    $geography = $student->subjects->sum('geography');

                    $total = $math + $khmer + $english + $history + $geography;
                    $countSubjects = 5; 
                    $average = $countSubjects ? round($total / $countSubjects, 2) : 0;
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="border-b py-2 px-4">{{ $student->id }}</td>
                    <td class="border-b py-2 px-4">{{ $student->user->name ?? 'N/A' }}</td>
                    <td class="border-b py-2 px-4">{{ $student->grade }}</td>
                    <td class="border-b py-2 px-4">{{ $math }}</td>
                    <td class="border-b py-2 px-4">{{ $khmer }}</td>
                    <td class="border-b py-2 px-4">{{ $english }}</td>
                    <td class="border-b py-2 px-4">{{ $history }}</td>
                    <td class="border-b py-2 px-4">{{ $geography }}</td>
                    <td class="border-b py-2 px-4 font-bold">{{ $total }}</td>
                    <td class="border-b py-2 px-4 font-bold">{{ $average }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="py-4 px-4 text-center text-gray-500">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
