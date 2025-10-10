<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <title>Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="container-fluid">
    <div class="row">

      <!-- Sidebar -->
      <div class="col-2 bg-white shadow-md min-h-screen p-6">
        <div class="text-center mb-8">
          <a href="{{ route('auth.profile') }}">
              <i class="fa-solid fa-user text-4xl text-blue-500 mb-2"></i>
          <h2 class="text-lg font-bold">{{ Auth::user()->name }}</h2>
          </a>
        
        </div>

        <nav class="flex flex-col space-y-4">
          <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
            <i class="fa-solid fa-house mr-2"></i> Dashboard
          </a>
          
                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('role.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
                            <i class="fa-solid fa-user-shield mr-2"></i> Role
                        </a>
                    @endif

                    
                    @if (Auth::user()->hasPermission('manage-teacher'))
                        <a href="{{ route('teacher.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
                            <i class="fa-solid fa-chalkboard-teacher mr-2"></i> Teacher
                        </a>
                    @endif

                   
                    @if (Auth::user()->hasPermission('add-student') || Auth::user()->hasPermission('view-student'))
                        <a href="{{ route('student.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
                            <i class="fa-solid fa-graduation-cap mr-2"></i> Student
                        </a>
                    @endif
               
<a href="{{ route('class.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
  <i class="fa-solid fa-school mr-2"></i> Class
</a>
        </nav>
       <form  class="mt-[400px]" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded hover:bg-red-100 font-semibold text-red-700 flex items-center w-full text-left">
                            <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
      </div>
{{-- /// --}}
{{-- @if (Auth::user()->hasRole('admin'))
  <a href="{{ route('role.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
    <i class="fa-solid fa-user-shield mr-2"></i> Role
  </a>
@endif
@if (Auth::user()->hasPermission('manage-teacher'))
  <a href="{{ route('teacher.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
    <i class="fa-solid fa-chalkboard-teacher mr-2"></i> Teacher
  </a>
@endif --}}


{{-- //// --}}
      <!-- Main content -->
      <div class="col-10 p-6">
        <div class="">
          @yield('content')
        </div>
      </div>

    </div>
  </div>

</body>
</html>
