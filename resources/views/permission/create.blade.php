@extends('layouts.app')

@section('title', 'ព័ត៌មានលម្អិតសំណើ - Request Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('permission.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fa-solid fa-arrow-left text-lg"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-file-lines text-blue-600"></i>
            ព័ត៌មានលម្អិតសំណើ / Request Details
        </h1>
    </div>

    <!-- Status -->
    <div class="mb-6 p-4 rounded-lg border border-gray-200 bg-gray-50 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-clock text-yellow-600 text-xl"></i>
            <div>
                <p class="font-semibold text-yellow-700">ស្ថានភាព: រងចាំការអនុម័ត</p>
                <p class="text-gray-500 text-sm">Status: Pending</p>
            </div>
        </div>
        <p class="text-gray-600 text-sm">ពិនិត្យនៅ: <span class="font-medium">-</span></p>
    </div>

    <!-- Main Details -->
    <div class="bg-white rounded-lg shadow-md border border-gray-100 mb-6">
        <div class="bg-blue-600 text-white px-6 py-3 rounded-t-lg font-semibold">
            ព័ត៌មានសំណើ / Request Information
        </div>

        <div class="p-6 grid md:grid-cols-2 gap-6">
            <!-- Requester -->
            <div>
                <p class="text-gray-600 text-sm mb-1">អ្នកស្នើសុំ / Requester</p>
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-blue-100 flex items-center justify-center rounded-full">
                        <i class="fa-solid fa-user text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">User Name</p>
                        <p class="text-gray-500 text-sm">user@example.com</p>
                    </div>
                </div>
            </div>

            <!-- Type -->
            <div>
                <p class="text-gray-600 text-sm mb-1">ប្រភេទសំណើ / Type</p>
                <p class="font-semibold text-gray-800">ឈប់សម្រាក / Leave</p>
                <p class="text-gray-500 text-sm">Annual Leave</p>
            </div>

            <!-- Submitted On -->
            <div>
                <p class="text-gray-600 text-sm mb-1">ដាក់ស្នើនៅ / Submitted On</p>
                <p class="font-semibold text-gray-800">25 Oct 2025, 08:45 AM</p>
            </div>

            <!-- Duration -->
            <div>
                <p class="text-gray-600 text-sm mb-1">រយៈពេលសរុប / Duration</p>
                <span class="inline-flex items-center bg-blue-100 text-blue-800 px-3 py-1 rounded-md font-semibold">
                    <i class="fa-solid fa-calendar-days mr-2"></i>3 ថ្ងៃ
                </span>
            </div>

            <!-- Start Date -->
            <div>
                <p class="text-gray-600 text-sm mb-1">ចាប់ផ្តើម / Start</p>
                <p class="font-semibold text-gray-800">26 Oct 2025</p>
            </div>

            <!-- End Date -->
            <div>
                <p class="text-gray-600 text-sm mb-1">បញ្ចប់ / End</p>
                <p class="font-semibold text-gray-800">28 Oct 2025</p>
            </div>
        </div>

        <!-- Reason -->
        <div class="px-6 pb-6">
            <p class="text-gray-600 text-sm mb-1">មូលហេតុ / Reason</p>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <p class="text-gray-800 leading-relaxed">ចង់ទៅជួបគ្រួសារនៅខេត្ត។ / Need to visit family in province.</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-wrap gap-3 justify-between">
        <a href="{{ route('permission.index') }}" class="px-5 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
            <i class="fa-solid fa-arrow-left mr-1"></i> ត្រឡប់ / Back
        </a>

        <div class="flex gap-3">
            <button class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                <i class="fa-solid fa-check mr-1"></i> អនុម័ត / Approve
            </button>
            <button class="px-5 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                <i class="fa-solid fa-xmark mr-1"></i> បដិសេធ / Reject
            </button>
        </div>
    </div>
</div>
@endsection
