@extends('layouts.app')

@section('title', 'Edit Role Permissions')

@section('content')
<div class="d-flex pt-10 justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-gear"></i> Edit Role Permissions</h1>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Roles
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    Manage Permissions for 
                    <span class="badge 
                        @if($role->name === 'admin') bg-danger
                        @elseif($role->name === 'teacher') bg-primary
                        @elseif($role->name === 'student') bg-success
                        @else bg-secondary
                        @endif">
                        {{ $role->display_name }}
                    </span>
                </h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <p class="text-muted mb-4">{{ $role->description }}</p>

                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="permissions[]" 
                                           id="permission_{{ $permission->id }}"
                                           value="{{ $permission->id }}"
                                           {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        <strong>{{ $permission->display_name }}</strong>
                                        @if($permission->description)
                                            <br><small class="text-muted">{{ $permission->description }}</small>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 border-top pt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg"></i> Update Permissions
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
