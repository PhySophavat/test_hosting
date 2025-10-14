@extends('layouts.app')
@section('content')


<div>
<h2>Grade 7A Students</h2>

<ul>
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
</ul>



</div>
@endsection