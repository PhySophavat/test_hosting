@extends('layouts.app')

@section('content')
<div class="p-10">
    @if(Auth::user()->hasPermission('add-student'))
    <h1 class="text-3xl font-bold mb-6 text-gray-800">ការគ្រប់គ្រងសិស្ស</h1>

    <!-- Add Student Button -->
    <div class="mb-6">
        <a href="{{ route('student.create') }}" 
           class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition font-semibold">
            បន្ថែមសិស្ស
        </a>
    </div>
    @endif

    <!-- Student Table -->
    @if(Auth::user()->hasPermission('add-student'))
    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">លេខសម្គាល់</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">ឈ្មោះ</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">អ៊ីមែល</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">ថ្នាក់</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700">សកម្មភាព</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $student->id }}</td>
                        <td class="px-4 py-2">{{ $student->user->name ?? 'មិនមាន' }}</td>
                        <td class="px-4 py-2">{{ $student->user->email ?? 'មិនមាន' }}</td>
                        <td class="px-4 py-2">{{ $student->grade }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('subject.create', $student->id) }}" 
                               class="text-blue-600 hover:underline font-medium">បន្ថែមពិន្ទុ</a>
                            @if (Auth::user()->hasRole('admin'))
                                <a href="{{ route('students.edit', $student) }}" 
                                   class="text-green-600 hover:underline font-medium">កែប្រែ</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:underline font-medium" 
                                            onclick="return confirm('តើអ្នកពិតជាចង់លុបសិស្សនេះ?')">
                                        លុប
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            មិនមានសិស្សនៅឡើយទេ
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

  
</div>
@endsection
