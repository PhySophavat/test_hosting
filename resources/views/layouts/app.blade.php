<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <title>Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-md p-6 flex flex-col">
      <div class="text-center mb-8">
        <a href="{{ route('auth.profile') }}">
          <i class="fa-solid fa-user text-4xl text-blue-500 mb-2"></i>
          <h2 class="text-lg font-bold">{{ Auth::user()->name }}</h2>
        </a>
      </div>

      <nav class="flex flex-col space-y-4 flex-1">
        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
          <i class="fa-solid fa-house mr-2"></i> ទំព័រដើម
        </a>

        @if (Auth::user()->hasRole('admin'))
        <a href="{{ route('role.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
          <i class="fa-solid fa-user-shield mr-2"></i> តួនាទី
        </a>
        @endif

        @if (Auth::user()->hasPermission('manage-teacher'))
        <a href="{{ route('teacher.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
          <i class="fa-solid fa-chalkboard-teacher mr-2"></i> គ្រូ
        </a>
        @endif

        @if (Auth::user()->hasPermission('add-student') || Auth::user()->hasPermission('view-student'))
        <a href="{{ route('student.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
          <i class="fa-solid fa-graduation-cap mr-2"></i> សិស្ស
        </a>
        @endif

        <a href="{{ route('class.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
          <i class="fa-solid fa-school mr-2"></i> ថ្នាក់
        </a>
        <a href="{{ route('class.index') }}" class="px-4 py-2 rounded hover:bg-blue-100 font-semibold text-gray-700 flex items-center">
          <i class="fa-solid fa-file mr-2"></i> លទ្ធផល
        </a>
      </nav>
     

      <form class="mt-auto" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 rounded hover:bg-red-100 font-semibold text-red-700 flex items-center w-full text-left">
          <i class="fa-solid fa-sign-out-alt mr-2"></i> ចាកចេញ
        </button>
      </form>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-6 overflow-auto">
      @yield('content')
    </div>

  </div>

</body>
</html>
