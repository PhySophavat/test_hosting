@extends('layouts.app')
@section('content')

<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-center mb-8">បញ្ជីលទ្ធផល</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($grades as $grade => $sections)
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-blue-600 mb-4">ថ្នាក់ {{ $grade }}</h2>
        <div class="grid grid-cols-4 gap-2">
          @foreach ($sections as $section)
            <a href="{{ route('result.show', $grade.$section) }}" 
              class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">
              {{ $grade.$section }}
            </a>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection
