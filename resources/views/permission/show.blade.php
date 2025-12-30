@extends('layouts.app')

@section('title', 'ព័ត៌មានលម្អិតសំណើច្បាប់ / Request Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('permission.index') }}" class="text-purple-600 hover:text-purple-800">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
            <i class="fa-solid fa-file-lines text-purple-600"></i>
            ព័ត៌មានលម្អិតសំណើច្បាប់ / Request Details
        </h1>
    </div>

    <!-- Card -->
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4">
            <h2 class="text-lg font-bold text-white">ព័ត៌មានសំណើ / Request Information</h2>
        </div>

        <div class="p-6 space-y-6">
            <!-- Requester -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">អ្នកស្នើសុំ / Requester</label>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-purple-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $request->user->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $request->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">ប្រភេទសំណើ / Request Type</label>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-tag text-purple-600"></i>
                        <span class="text-gray-900 font-semibold">{{ $request->type ?? 'N/A' }}</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">កាលបរិច្ឆេទចាប់ផ្តើម / Start Date</label>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar-day text-blue-600"></i>
                        <span class="text-gray-900">{{ $request->start_date ?? '-' }}</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">កាលបរិច្ឆេទបញ្ចប់ / End Date</label>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar-day text-blue-600"></i>
                        <span class="text-gray-900">{{ $request->end_date ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Reason -->
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">មូលហេតុ / Reason</label>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <p class="text-gray-800 leading-relaxed">
                        {{ $request->reason ?? 'គ្មានមូលហេតុ / No reason provided' }}
                    </p>
                </div>
            </div>

            <!-- Duration -->
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">រយៈពេលសរុប / Total Duration</label>
                <div class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-100 border border-blue-300">
                    <i class="fa-solid fa-calendar-days text-blue-700 mr-2"></i>
                    <span class="text-blue-900 font-bold text-lg">
                        {{ $request->total_days ?? '0' }} ថ្ងៃ / days
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="mt-6 flex justify-between">
        <a href="{{ route('permission.index') }}" 
           class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-semibold transition">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            ត្រឡប់ / Back
        </a>

        <a href="{{ , $request->id) }}" 
           class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition shadow-lg">
            <i class="fa-solid fa-pen mr-2"></i>
            កែប្រែ / Edit
        </a>
    </div>
</div>
@endsection
