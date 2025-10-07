@extends('layouts.app')
@section('content')
    <div class="p-10 mt-4">
        <h1 class="font-bold">Role Manage</h1>

        <div>

        
<div class="row mt-5">
     
    @foreach($roles as $role)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">
                    <span class="badge font-bold
                    @if($role->name === 'admin')
                        bg-red-500 text-white
                    @elseif($role->name === 'teacher') 
                        bg-blue-500 text-white
                    @elseif($role->name === 'student') 
                        bg-green-500 text-white
                    @else
                        bg-gray-200 text-black
                    @endif
                 ">
                   {{ $role->display_name }}
                </span>

                </h1>
             
            </div>
            <div class="card-body">
                <p class="text-muted">{{ $role->description }}</p>
                
          
                <div class="mb-3">


                    @forelse($role->permissions as $permission)
                    <span class="badge bg-success me-1 mb-1">
                        <i class="bi bi-check"></i> {{ $permission->display_name }}
                    </span>
                    @empty
                    <span class="badge bg-light text-dark">No permissions assigned</span>
                  
                    @endforelse
                </div>
            </div>
            {{-- <div class="card-footer">
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary w-100">
                    <i class="bi bi-gear"></i> Edit Permissions
                </a>
            </div> --}}
        </div>
    </div>
    @endforeach

            {{-- <h1>My Role</h1>
           <p><strong>{{ auth()->user()->role->name }}</strong></p>
           <ul>
               @foreach (auth()->user()->role->permissions as $permission)
                   <li>{{ $permission->name }}</li>
               @endforeach
           </ul> --}}

</div>


    </div>
@endsection