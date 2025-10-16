@extends('layouts.app')

@section('content')
<div class="p-10">
    <h1 class="text-2xl font-bold mb-5">ផ្តល់សិទ្ធិសម្រាប់ {{ $user->name }}</h1>

    <form action="{{ route('user.permissions.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                           id="perm_{{ $permission->id }}"
                           {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}
                           class="form-check-input">
                    <label for="perm_{{ $permission->id }}" class="form-check-label">
                        {{ $permission->display_name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            រក្សាទុក
        </button>
    </form>
</div>
@endsection
