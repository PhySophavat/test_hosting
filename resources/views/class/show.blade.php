@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-people-fill text-blue-600"></i>
                បញ្ជីសិស្សថ្នាក់ {{ $className }}
            </h2>

            <a href="{{ route('students.create') }}" 
               class="flex items-center gap-2 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition font-medium shadow-sm">
                <i class="bi bi-plus-circle"></i>
                បន្ថែមសិស្ស
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">ល.រ</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">ឈ្មោះ</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">អ៊ីមែល</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700 border-b">ថ្នាក់</th>
                        <th class="py-3 px-4 text-center font-semibold text-gray-700 border-b">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr class="hover:bg-blue-50 even:bg-gray-50 transition">
                            <td class="py-3 px-4 border-b text-gray-700">{{ $student->id }}</td>
                            <td class="py-3 px-4 border-b text-gray-800 font-medium">{{ $student->user->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $student->user->email ?? 'N/A' }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $student->grade }}</td>
                            <td class="py-3 px-4 border-b text-center space-x-2">
                                <a href="{{ route('subject.create', $student->id) }}" 
                                   class="inline-block text-blue-600 hover:text-blue-800 font-medium">
                                   <i class="bi bi-plus-circle"></i> បញ្ជូលពិន្ទុ
                                </a>

                                @if (Auth::user()->hasRole('admin'))
                                    <a href="{{ route('students.edit', $student) }}" 
                                       class="inline-block text-green-600 hover:text-green-800 font-medium">
                                       <i class="bi bi-pencil-square"></i> កែប្រែ
                                    </a>

                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 font-medium" 
                                                onclick="return confirm('Delete this student?')">
                                            <i class="bi bi-trash3"></i> លុប
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 px-4 text-center text-gray-500">
                                បញ្ជីឈ្មោះសិស្សថ្នាក់ {{ $className }} មិនមានទេ។
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
