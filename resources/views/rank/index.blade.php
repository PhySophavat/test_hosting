@extends('layouts.app')

@section('content')
<div class="container mx-auto bg-white rounded-lg shadow-md p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2 md:mb-0">សម្រាប់ថ្នាក់ {{ $className }}</h1>
        <a href="{{ url()->previous() }}" class="text-sm text-blue-600 hover:underline flex items-center gap-1">
            ← ត្រឡប់
        </a>
    </div>

    <!-- Month & Year Filter -->
    <div class="mb-4">
        <form method="GET" action="{{ route('rank.index', $className) }}" class="flex items-center gap-2 flex-wrap">
            <label for="month" class="font-medium">ជ្រើសរើសខែ:</label>
            <select id="month" name="month" class="border px-3 py-1 rounded" onchange="this.form.submit()">
                <option value="">-- ជ្រើសរើស --</option>
                @foreach([
                    1 => 'មករា', 2 => 'កុម្ភៈ', 3 => 'មីនា', 4 => 'មេសា',
                    5 => 'ឧសភា', 6 => 'មិថុនា', 7 => 'កក្កដា', 8 => 'សីហា',
                    9 => 'កញ្ញា', 10 => 'តុលា', 11 => 'វិច្ឆិកា', 12 => 'ធ្នូ'
                ] as $num => $name)
                    <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>

            <label for="year" class="font-medium">ឆ្នាំ:</label>
            <input type="number" name="year" id="year" class="border px-3 py-1 rounded w-24"
                   value="{{ $selectedYear ?? date('Y') }}" onchange="this.form.submit()">
        </form>
    </div>

    <!-- Student Rank Table -->
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-blue-50">
                <tr>
                    <th class="py-2 px-3 text-left font-semibold uppercase tracking-wider">ល.រ</th>
                    <th class="py-2 px-3 text-left font-semibold uppercase tracking-wider">ឈ្មោះ</th>
                    <th class="py-2 px-3 text-left font-semibold uppercase tracking-wider">សរុប</th>
                    <th class="py-2 px-3 text-left font-semibold uppercase tracking-wider">ចំណាត់ថ្នាក់</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rankedStudents as $row)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="py-2 px-3 border-b">{{ $row['student']->id }}</td>
                        <td class="py-2 px-3 border-b">{{ $row['student']->user->name ?? 'N/A' }}</td>
                        <td class="py-2 px-3 border-b font-semibold text-blue-600">{{ number_format($row['total'], 2) }}</td>
                        <td class="py-2 px-3 border-b">{{ $row['rank'] ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-3 text-center text-gray-500">
                            មិនមានសិស្សសម្រាប់ថ្នាក់ {{ $className }} ទេ។
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Statistics / Summary -->
    <div class="p-4 bg-gray-50 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">ព័ត៌មានបន្ថែម</h2>
        <div class="space-y-2">
            <p><strong>ចំនួនសិស្សសរុប:</strong> {{ $stats['total_students'] }}</p>
             
          
            {{-- @if($stats['top_student'])
                <p><strong>សិស្សថ្នាក់ 1:</strong> {{ $stats['top_student']['student']->user->name ?? 'N/A' }}</p>
            @endif --}}
        </div>
    </div>
</div>
@endsection
