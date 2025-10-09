@extends('layouts.app')

@section('content')
<div class="p-10 mt-4">
    <h1 class="font-bold text-2xl mb-5">Role Management</h1>

    <div class="row">
        @forelse($roles as $role)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm rounded-2xl">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="mb-0">
                            <span class="badge font-bold px-3 py-2 text-white
                                @if($role->name === 'admin')
                                    bg-red-500
                                @elseif($role->name === 'teacher') 
                                    bg-blue-500
                                @elseif($role->name === 'student') 
                                    bg-green-500
                                @else
                                    bg-gray-500
                                @endif
                            ">
                                {{ $role->display_name }}
                            </span>
                        </h1>
                    </div>

                    <div class="card-body">
                        <p class="text-muted mb-3">{{ $role->description ?? 'No description available.' }}</p>

                        <div class="mb-3">
                            @forelse($role->permissions as $permission)
                                <span class="badge bg-success me-1 mb-1">
                                    <i class="bi bi-check-circle"></i> {{ $permission->display_name }}
                                </span>
                            @empty
                                <span class="badge bg-light text-dark">No permissions assigned</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary w-100">
                            <i class="bi bi-gear"></i> Edit Permissions
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">No roles found.</p>
        @endforelse
    </div>
</div>
@endsection
