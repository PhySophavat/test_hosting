@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <i class="fa-solid fa-clock-rotate-left text-blue-600"></i>
            Activity Logs
        </h1>
        <p class="text-gray-600 mt-2">Track all system activities and changes</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-600 to-indigo-600">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Action</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Description</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Changes</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Time</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Details</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <!-- User -->
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-user text-blue-600"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'Guest' }}</div>
                                    <div class="text-xs text-gray-500">ID: {{ $log->user_id ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Action -->
                        <td class="px-4 py-4 whitespace-nowrap">
                            @php
                                $actionColors = [
                                    'create' => 'bg-green-100 text-green-800 border-green-300',
                                    'update' => 'bg-blue-100 text-blue-800 border-blue-300',
                                    'delete' => 'bg-red-100 text-red-800 border-red-300',
                                    'default' => 'bg-gray-100 text-gray-800 border-gray-300'
                                ];
                                $actionType = 'default';
                                foreach(['create', 'update', 'delete'] as $type) {
                                    if(str_contains(strtolower($log->action), $type)) {
                                        $actionType = $type;
                                        break;
                                    }
                                }
                                $colorClass = $actionColors[$actionType];
                            @endphp
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full border {{ $colorClass }}">
                                {{ str_replace('_', ' ', ucwords($log->action, '_')) }}
                            </span>
                        </td>

                        <!-- Description -->
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $log->description }}">
                                {{ $log->description }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fa-solid fa-network-wired"></i> {{ $log->ip_address ?? 'N/A' }}
                            </div>
                        </td>

                        <!-- Changes Summary -->
                        <td class="px-4 py-4">
                            @php
                                $oldValues = is_array($log->old_values) ? $log->old_values : json_decode($log->old_values, true) ?? [];
                                $newValues = is_array($log->new_values) ? $log->new_values : json_decode($log->new_values, true) ?? [];
                                $hasOld = !empty($oldValues);
                                $hasNew = !empty($newValues);
                            @endphp
                            
                            <div class="flex items-center gap-2 text-xs">
                                @if($hasOld)
                                    <span class="bg-red-50 text-red-700 px-2 py-1 rounded border border-red-200">
                                        <i class="fa-solid fa-circle-minus"></i> Old
                                    </span>
                                @endif
                                @if($hasOld && $hasNew)
                                    <i class="fa-solid fa-arrow-right text-gray-400"></i>
                                @endif
                                @if($hasNew)
                                    <span class="bg-green-50 text-green-700 px-2 py-1 rounded border border-green-200">
                                        <i class="fa-solid fa-circle-plus"></i> New
                                    </span>
                                @endif
                                @if(!$hasOld && !$hasNew)
                                    <span class="text-gray-400 italic">No changes</span>
                                @endif
                            </div>
                        </td>

                        <!-- Time -->
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $log->created_at->diffForHumans() }}</div>
                            <div class="text-xs text-gray-500">{{ $log->created_at->format('M d, Y H:i') }}</div>
                        </td>

                        <!-- View Details Button -->
                        <td class="px-4 py-4 text-center whitespace-nowrap">
                            <button 
                                onclick="showLogDetails({{ $log->id }})"
                                class="text-blue-600 hover:text-blue-800 font-medium text-sm hover:underline"
                            >
                                <i class="fa-solid fa-eye"></i> View
                            </button>
                        </td>
                    </tr>

                    <!-- Hidden Details Row -->
                    <tr id="details-{{ $log->id }}" class="hidden bg-gray-50">
                        <td colspan="6" class="px-4 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Old Values -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fa-solid fa-history text-red-600"></i>
                                        Old Values
                                    </h4>
                                    @if(!empty($oldValues))
                                        <div class="bg-white border border-red-200 rounded-lg p-3 max-h-64 overflow-y-auto">
                                            @foreach($oldValues as $key => $value)
                                                @if(!in_array($key, ['id', 'created_at', 'updated_at']))
                                                    <div class="mb-2 pb-2 border-b border-gray-100 last:border-0">
                                                        <span class="text-xs font-semibold text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                        <div class="text-sm text-gray-800 mt-1">
                                                            @if(is_array($value))
                                                                <pre class="text-xs bg-gray-50 p-2 rounded overflow-x-auto">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            @else
                                                                {{ $value ?? 'null' }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center text-gray-500 text-sm">
                                            No old values recorded
                                        </div>
                                    @endif
                                </div>

                                <!-- New Values -->
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                        <i class="fa-solid fa-sparkles text-green-600"></i>
                                        New Values
                                    </h4>
                                    @if(!empty($newValues))
                                        <div class="bg-white border border-green-200 rounded-lg p-3 max-h-64 overflow-y-auto">
                                            @foreach($newValues as $key => $value)
                                                @if(!in_array($key, ['id', 'created_at', 'updated_at']))
                                                    <div class="mb-2 pb-2 border-b border-gray-100 last:border-0">
                                                        <span class="text-xs font-semibold text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                        <div class="text-sm text-gray-800 mt-1">
                                                            @if(is_array($value))
                                                                <pre class="text-xs bg-gray-50 p-2 rounded overflow-x-auto">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                            @else
                                                                {{ $value ?? 'null' }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="bg-white border border-gray-200 rounded-lg p-3 text-center text-gray-500 text-sm">
                                            No new values recorded
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div class="mt-4 bg-white border border-gray-200 rounded-lg p-3">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Additional Information</h4>
                                <div class="grid grid-cols-2 gap-4 text-xs text-gray-600">
                                    <div>
                                        <span class="font-semibold">IP Address:</span> {{ $log->ip_address ?? 'N/A' }}
                                    </div>
                                    <div>
                                        <span class="font-semibold">Timestamp:</span> {{ $log->created_at->format('Y-m-d H:i:s') }}
                                    </div>
                                </div>
                                @if($log->user_agent)
                                <div class="mt-2 text-xs text-gray-600">
                                    <span class="font-semibold">User Agent:</span> {{ Str::limit($log->user_agent, 100) }}
                                </div>
                                @endif
                            </div>

                            <div class="mt-3 text-right">
                                <button 
                                    onclick="hideLogDetails({{ $log->id }})"
                                    class="text-sm text-gray-600 hover:text-gray-800"
                                >
                                    <i class="fa-solid fa-times"></i> Close
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-inbox text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg font-medium">No activity logs found</p>
                                <p class="text-gray-400 text-sm mt-1">Activity logs will appear here once actions are performed</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
            {{ $logs->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>

<script>
function showLogDetails(logId) {
    document.getElementById('details-' + logId).classList.remove('hidden');
}

function hideLogDetails(logId) {
    document.getElementById('details-' + logId).classList.add('hidden');
}
</script>

<style>
pre {
    white-space: pre-wrap;
    word-wrap: break-word;
}
</style>
@endsection