@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">សម្រាប់ថ្នាក់ {{ $className }} </h1>
        <a href="{{ url()->previous() }}" class="text-sm text-gray-600 hover:underline">← ត្រឡប់</a>
    </div>

    <div class="bg-white rounded-lg shadow p-4 overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                   
                    <th class="py-2 px-4 text-left">ល.រ</th>
                    <th class="py-2 px-4 text-left">ឈ្មោះ</th>
                    <th class="py-2 px-4 text-left">សរុប</th>
                     <th class="py-2 px-4 text-left">ចំណាត់ថ្នាក់</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rankedStudents as $row)
                    <tr class="hover:bg-gray-50">
                     
                        <td class="py-2 px-4">{{ $row['student']->id }}</td>
                        <td class="py-2 px-4">{{ $row['student']->user->name ?? 'N/A' }}</td>
                        <td class="py-2 px-4 font-semibold text-blue-600">{{ number_format($row['total'], 2) }}</td>
                        <td class="py-2 px-4">{{ $row['rank'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">No students found for {{ $className }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection