@extends('layouts.app')

@section('title', 'សំណើច្បាប់ - Permission Requests')

@section('content')
<h1>well come </h1>
{{-- <div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <i class="fa-solid fa-user-shield text-purple-600"></i>
                សំណើច្បាប់ / Permission Requests
            </h1>
            <p class="text-gray-600 mt-2">
                @if($isAdmin)
                    គ្រប់គ្រងសំណើច្បាប់ទាំងអស់ / Manage all permission requests
                @else
                    សំណើច្បាប់របស់ខ្ញុំ / My permission requests
                @endif
            </p>
        </div>
        <a href="{{ route('permission.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center gap-2 transition shadow-lg">
            <i class="fa-solid fa-plus"></i>
            បង្កើតសំណើច្បាប់ថ្មី
        </a>
    </div>

    <!-- Stats Cards (Admin only) -->
    @if($isAdmin)
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">រងចាំ / Pending</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pendingCount }}</p>
                </div>
                <i class="fa-solid fa-clock text-yellow-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">អនុម័ត / Approved</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $requests->where('status', 'approved')->count() }}</p>
                </div>
                <i class="fa-solid fa-check-circle text-green-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">បដិសេធ / Rejected</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $requests->where('status', 'rejected')->count() }}</p>
                </div>
                <i class="fa-solid fa-times-circle text-red-500 text-3xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">សរុប / Total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $requests->total() }}</p>
                </div>
                <i class="fa-solid fa-list text-blue-500 text-3xl"></i>
            </div>
        </div>
    </div>
    @endif

    <!-- Requests Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-purple-600 to-indigo-600">
                    <tr>
                        @if($isAdmin)
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">អ្នកស្នើសុំ / User</th>
                        @endif
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">ប្រភេទ / Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">កាលបរិច្ឆេទ / Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">រយៈពេល / Duration</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">មូលហេតុ / Reason</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">ស្ថានភាព / Status</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase">សកម្មភាព / Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50 transition">
                        @if($isAdmin)
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-user text-purple-600"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        @endif

                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $request->type_khmer }}</div>
                            <div class="text-xs text-gray-500">{{ ucwords(str_replace('_', ' ', $request->type)) }}</div>
                        </td>

                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $request->start_date->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">to {{ $request->end_date->format('d M Y') }}</div>
                        </td>

                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                <i class="fa-solid fa-calendar-days mr-1"></i>
                                {{ $request->total_days }} ថ្ងៃ
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-700 max-w-xs truncate" title="{{ $request->reason }}">
                                {{ Str::limit($request->reason, 50) }}
                            </div>
                        </td>

                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full border {{ $request->status_color }}">
                                @if($request->status === 'pending')
                                    <i class="fa-solid fa-clock mr-1"></i> រងចាំ
                                @elseif($request->status === 'approved')
                                    <i class="fa-solid fa-check mr-1"></i> អនុម័ត
                                @else
                                    <i class="fa-solid fa-times mr-1"></i> បដិសេធ
                                @endif
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('permission.show', $request) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if($isAdmin && $request->status === 'pending')
                                    <button onclick="approveRequest({{ $request->id }})" class="text-green-600 hover:text-green-800" title="អនុម័ត">
                                        <i class="fa-solid fa-check-circle"></i>
                                    </button>
                                    <button onclick="rejectRequest({{ $request->id }})" class="text-red-600 hover:text-red-800" title="បដិសេធ">
                                        <i class="fa-solid fa-times-circle"></i>
                                    </button>
                                @endif

                                @if(!$isAdmin && $request->status === 'pending')
                                    <form action="{{ route('permission.cancel', $request) }}" method="POST" class="inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបសំណើនេះមែនទេ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="លុបចោល">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $isAdmin ? 7 : 6 }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-inbox text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500 text-lg font-medium">មិនមានសំណើច្បាប់ / No permission requests</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
            {{ $requests->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">អនុម័តសំណើច្បាប់ / Approve Request</h3>
        <form id="approveForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">កំណត់ចំណាំ (ស្រេចចិត្ត) / Note (Optional)</label>
                <textarea name="admin_note" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="បញ្ចូលកំណត់ចំណាំ..."></textarea>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeModal('approveModal')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">បោះបង់</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">អនុម័ត</button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">បដិសេធសំណើច្បាប់ / Reject Request</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">មូលហេតុ (ចាំបាច់) / Reason (Required) *</label>
                <textarea name="admin_note" rows="3" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500" placeholder="សូមបញ្ចូលមូលហេតុនៃការបដិសេធ..."></textarea>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeModal('rejectModal')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">បោះបង់</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">បដិសេធ</button>
            </div>
        </form>
    </div>
</div>

<script>
function approveRequest(id) {
    document.getElementById('approveForm').action = `/permissions/${id}/approve`;
    document.getElementById('approveModal').classList.remove('hidden');
}

function rejectRequest(id) {
    document.getElementById('rejectForm').action = `/permissions/${id}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
</script> --}}
@endsection