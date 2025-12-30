@extends('layouts.app')

@section('title', 'សំណើច្បាប់ - Permission Requests')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
                <i class="fa-solid fa-user-shield text-purple-600"></i>
                សំណើច្បាប់
            </h1>
            <p class="text-gray-600 mt-2">
                @if($isAdmin)
                    គ្រប់គ្រងសំណើច្បាប់ទាំងអស់ / Manage all permission requests
                @else
                    សំណើច្បាប់របស់ខ្ញុំ / My permission requests
                @endif
            </p>
        </div>
        <a href="{{ route('permission.create') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center gap-2 transition shadow-lg transform hover:scale-105">
            <i class="fa-solid fa-plus"></i>
            បង្កើតសំណើថ្មី
        </a>
    </div>

    <!-- Stats Cards (Admin only) -->
    @if($isAdmin)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Pending Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 transform transition hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase mb-1">រងចាំ</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingCount }}</p>
                    <p class="text-xs text-gray-500 mt-1">Pending</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fa-solid fa-clock text-yellow-600 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Approved Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform transition hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase mb-1">អនុម័ត</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $requests->where('status', 'approved')->count() }}</p>
                    <p class="text-xs text-gray-500 mt-1">Approved</p>
                </div>
                <div class="bg-green-100 rounded-full p-4">
                    <i class="fa-solid fa-check-circle text-green-600 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 transform transition hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase mb-1">បដិសេធ</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $requests->where('status', 'rejected')->count() }}</p>
                    <p class="text-xs text-gray-500 mt-1">Rejected</p>
                </div>
                <div class="bg-red-100 rounded-full p-4">
                    <i class="fa-solid fa-times-circle text-red-600 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 transform transition hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase mb-1">សរុប</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $requests->total() }}</p>
                    <p class="text-xs text-gray-500 mt-1">Total</p>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <i class="fa-solid fa-list text-blue-600 text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <button onclick="filterRequests('all')" class="filter-btn px-4 py-2 rounded-lg font-semibold transition active" data-filter="all">
                <i class="fa-solid fa-list mr-2"></i>
                ទាំងអស់ / All
            </button>
            <button onclick="filterRequests('pending')" class="filter-btn px-4 py-2 rounded-lg font-semibold transition" data-filter="pending">
                <i class="fa-solid fa-clock mr-2"></i>
                រងចាំ / Pending
            </button>
            <button onclick="filterRequests('approved')" class="filter-btn px-4 py-2 rounded-lg font-semibold transition" data-filter="approved">
                <i class="fa-solid fa-check-circle mr-2"></i>
                អនុម័ត / Approved
            </button>
            <button onclick="filterRequests('rejected')" class="filter-btn px-4 py-2 rounded-lg font-semibold transition" data-filter="rejected">
                <i class="fa-solid fa-times-circle mr-2"></i>
                បដិសេធ / Rejected
            </button>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-purple-600 to-indigo-600">
                    <tr>
                        @if($isAdmin)
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-user mr-2"></i>អ្នកស្នើសុំ
                        </th>
                        @endif
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-tag mr-2"></i>ប្រភេទ
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-calendar mr-2"></i>កាលបរិច្ឆេទ
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-hourglass-half mr-2"></i>រយៈពេល
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-comment mr-2"></i>មូលហេតុ
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-info-circle mr-2"></i>ស្ថានភាព
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                            <i class="fa-solid fa-cog mr-2"></i>សកម្មភាព
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50 transition request-row" data-status="{{ $request->status }}">
                        @if($isAdmin)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-full flex items-center justify-center shadow-md">
                                    <span class="text-white font-bold text-lg">{{ strtoupper(substr($request->user->name, 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $request->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        @endif

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-tag text-purple-600"></i>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $request->type_khmer }}</div>
                                    <div class="text-xs text-gray-500">{{ ucwords(str_replace('_', ' ', $request->type)) }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-semibold">{{ $request->start_date->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">to {{ $request->end_date->format('d M Y') }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md">
                                <i class="fa-solid fa-calendar-days mr-1"></i>
                                {{ $request->total_days }} ថ្ងៃ
                            </span>
                        </td>

                        <td class="px-6 py-4 max-w-xs">
                            <div class="text-sm text-gray-700 truncate" title="{{ $request->reason }}">
                                {{ Str::limit($request->reason, 50) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border-2 {{ $request->status_color }}">
                                @if($request->status === 'pending')
                                    <i class="fa-solid fa-clock mr-1"></i> រងចាំ
                                @elseif($request->status === 'approved')
                                    <i class="fa-solid fa-check mr-1"></i> អនុម័ត
                                @else
                                    <i class="fa-solid fa-times mr-1"></i> បដិសេធ
                                @endif
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('permission.show', $request) }}" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition" title="មើល / View">
                                    <i class="fa-solid fa-eye text-lg"></i>
                                </a>

                                @if($isAdmin && $request->status === 'pending')
                                    <button onclick="approveRequest({{ $request->id }})" class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition" title="អនុម័ត / Approve">
                                        <i class="fa-solid fa-check-circle text-lg"></i>
                                    </button>
                                    <button onclick="rejectRequest({{ $request->id }})" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition" title="បដិសេធ / Reject">
                                        <i class="fa-solid fa-times-circle text-lg"></i>
                                    </button>
                                @endif

                                @if(!$isAdmin && $request->status === 'pending')
                                    <form action="{{ route('permission.cancel', $request) }}" method="POST" class="inline" onsubmit="return confirm('តើអ្នកពិតជាចង់លុបសំណើនេះមែនទេ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition" title="លុបចោល / Cancel">
                                            <i class="fa-solid fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $isAdmin ? 7 : 6 }}" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-100 rounded-full p-8 mb-4">
                                    <i class="fa-solid fa-inbox text-gray-300 text-6xl"></i>
                                </div>
                                <p class="text-gray-500 text-xl font-semibold">មិនមានសំណើច្បាប់</p>
                                <p class="text-gray-400 text-sm mt-2">No permission requests found</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $requests->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all">
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 rounded-t-xl">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i>
                អនុម័តសំណើច្បាប់
            </h3>
            <p class="text-green-100 text-sm mt-1">Approve Permission Request</p>
        </div>
        <form id="approveForm" method="POST" class="p-6">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    កំណត់ចំណាំ (ស្រេចចិត្ត) / Note (Optional)
                </label>
                <textarea name="admin_note" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="បញ្ចូលកំណត់ចំណាំរបស់អ្នក..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('approveModal')" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
                    <i class="fa-solid fa-times mr-2"></i>បោះបង់
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold transition shadow-lg">
                    <i class="fa-solid fa-check mr-2"></i>អនុម័ត
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all">
        <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 rounded-t-xl">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-times-circle"></i>
                បដិសេធសំណើច្បាប់
            </h3>
            <p class="text-red-100 text-sm mt-1">Reject Permission Request</p>
        </div>
        <form id="rejectForm" method="POST" class="p-6">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    មូលហេតុ (ចាំបាច់) / Reason (Required) <span class="text-red-500">*</span>
                </label>
                <textarea name="admin_note" rows="4" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500" placeholder="សូមបញ្ចូលមូលហេតុនៃការបដិសេធ..."></textarea>
                <p class="text-sm text-gray-500 mt-2">សូមពន្យល់អំពីមូលហេតុនៃការបដិសេធ</p>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('rejectModal')" class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
                    <i class="fa-solid fa-times mr-2"></i>បោះបង់
                </button>
                <button type="submit" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold transition shadow-lg">
                    <i class="fa-solid fa-ban mr-2"></i>បដិសេធ
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.filter-btn {
    background: #f3f4f6;
    color: #6b7280;
}

.filter-btn:hover {
    background: #e5e7eb;
}

.filter-btn.active {
    background: linear-gradient(to right, #7c3aed, #4f46e5);
    color: white;
}
</style>

<script>
let currentFilter = 'all';

function filterRequests(status) {
    currentFilter = status;
    
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-filter="${status}"]`).classList.add('active');
    
    // Filter rows
    document.querySelectorAll('.request-row').forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

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

// Close modal when clicking outside
document.querySelectorAll('[id$="Modal"]').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal(this.id);
        }
    });
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('approveModal');
        closeModal('rejectModal');
    }
});
</script>
@endsection