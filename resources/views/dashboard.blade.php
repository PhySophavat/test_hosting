@extends('layouts.app')

@section('content')
<div class="p-10  min-h-screen">

    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <i class="bi bi-speedometer2 text-blue-600"></i>
            Welcome to Dashboard
        </h1>
        <p class="text-gray-600 mt-2 text-lg">
            Hello, <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span> 👋
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Users -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm uppercase font-semibold">Total Users</h2>
                    <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $users }}</h1>
                </div>
                <i class="bi bi-people-fill text-indigo-500 text-4xl"></i>
            </div>
        </div>

        <!-- Students -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm uppercase font-semibold">Total Students</h2>
                    <h1 class="text-3xl font-bold text-blue-600 mt-2">{{ $students }}</h1>
                </div>
                <i class="bi bi-mortarboard-fill text-blue-500 text-4xl"></i>
            </div>
        </div>

        <!-- Teachers -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-gray-500 text-sm uppercase font-semibold">Total Teachers</h2>
                    <h1 class="text-3xl font-bold text-green-600 mt-2">{{ $teachers }}</h1>
                </div>
                <i class="bi bi-person-workspace text-green-500 text-4xl"></i>
            </div>
        </div>
    </div>

    <!-- Optional: Add more sections below -->
    {{-- Example: recent activity, charts, etc. --}}
</div>
@endsection
