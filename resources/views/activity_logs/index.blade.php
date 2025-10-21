@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
        <i class="fa-solid fa-list-check text-blue-600"></i>
        Activity Logs
    </h1>

    <div class="bg-white rounded-xl  overflow-hidden border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">User ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">IP Address</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Time</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($logs as $log)
                <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-user-circle text-blue-500"></i>
                        {{ $log->user->name ?? 'Guest' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $log->user_id ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                            {{ $log->action }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $log->description }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        <i class="fa-solid fa-location-dot text-gray-400 mr-1"></i>
                        {{ $log->ip_address ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-700">
                        <div>
                            {{ $log->created_at->diffForHumans() }}
                            <div class="text-xs text-gray-400">
                                {{ $log->created_at->format('Y-m-d H:i:s') }}
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 text-lg">
                        <i class="fa-solid fa-circle-info text-gray-400 mr-2"></i>
                        No activity logs found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $logs->links('pagination::tailwind') }}
    </div>
</div>
@endsection
