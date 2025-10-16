@extends('layouts.app')

@section('content')
<div class="p-10">
    <!-- Page Title -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">គ្រប់គ្រងគ្រូបង្រៀន</h1>
        <a href="{{ route('teacher.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + បន្ថែមគ្រូថ្មី
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Teacher Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">ល.រ</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">ឈ្មោះ</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">អ៊ីម៉ែល</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">មុខវិជ្ជា</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">កម្រិត</th>
                    <th class="px-4 py-2 text-center text-gray-700 font-semibold">សកម្មភាព</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($teachers as $index => $teacher)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $teacher->user->name }}</td>
                        <td class="px-4 py-2">{{ $teacher->user->email }}</td>
                        <td class="px-4 py-2">{{ $teacher->subject }}</td>
                        <td class="px-4 py-2">{{ $teacher->class_assigned }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('teacher.edit', $teacher) }}" class="text-blue-600 hover:underline mr-2">កែប្រែ</a>
                            <form action="{{ route('teacher.destroy', $teacher) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('តើអ្នកចង់លុបគ្រូនេះមែនទេ?')">លុប</button>
                            </form>
                        <a href="{{ route('user.permissions.edit', $teacher->user->id) }}" 
   class="inline-flex items-center text-white bg-blue-600 px-3 py-1.5 rounded-md text-xs font-medium hover:bg-blue-700 transition">
    <i class="bi bi-shield-check"></i> ផ្តល់សិទ្ធិ
</a>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">មិនមានគ្រូបង្រៀននៅឡើយទេ។</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
