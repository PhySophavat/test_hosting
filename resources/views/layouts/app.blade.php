<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<body>
<div class="row">
<div class=" col-2">
  
    <div class="block p-10">
        <div class="p-5">
        <a class="font-bold" href="{{ route('dashboard') }}" >Dashboard</a>
      </div>
      <div class="p-5">
        <a class="font-bold" href="{{ route('role.index') }}">Role</a>
      </div>
       <div class="p-5">
        <a class="font-bold" href="{{ route('teacher.index') }}">Teacher</a>
      </div>
       <div class="p-5">
        <a class="font-bold" href="{{ route('student.index') }}">Student</a>
      </div>
       <div class="p-5">
       {{-- <a class="font-bold" href="{{ route('score.index') }}">Score</a> --}}

      </div>
    </div>
   
  </div>

  <div  class="col-10">

        @yield('content')
</div>
</div>
</body>
</html>