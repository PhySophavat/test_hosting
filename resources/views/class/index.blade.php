@extends('layouts.app')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Class Directory</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        {{-- Grade 7 --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-blue-600 mb-4">Grade 7</h2>
            <div class="grid grid-cols-4 gap-2">
      <a href="" 
   class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">
   7A
</a>

   <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7B</a>
                <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7C</a>
                <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7D</a>
                <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7E</a>
                <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7F</a>
                <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7G</a>
                <a href="#" class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">7H</a>
            </div>
        </div>

        {{-- Grade 8 --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-green-600 mb-4">Grade 8</h2>
            <div class="grid grid-cols-4 gap-2">
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8A</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8B</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8C</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8D</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8E</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8F</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8G</a>
                <a href="#" class="border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">8H</a>
            </div>
        </div>

        {{-- Grade 9 --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-yellow-600 mb-4">Grade 9</h2>
            <div class="grid grid-cols-4 gap-2">
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9A</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9B</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9C</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9D</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9E</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9F</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9G</a>
                <a href="#" class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">9H</a>
            </div>
        </div>

        {{-- Grade 10 --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-red-600 mb-4">Grade 10</h2>
            <div class="grid grid-cols-4 gap-2">
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10A</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10B</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10C</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10D</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10E</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10F</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10G</a>
                <a href="#" class="border-2 border-red-500 text-red-600 hover:bg-red-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">10H</a>
            </div>
        </div>

        {{-- Grade 11 --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-cyan-600 mb-4">Grade 11</h2>
            <div class="grid grid-cols-4 gap-2">
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11A</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11B</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11C</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11D</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11E</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11F</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11G</a>
                <a href="#" class="border-2 border-cyan-500 text-cyan-600 hover:bg-cyan-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">11H</a>
            </div>
        </div>

        {{-- Grade 12 --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-600 mb-4">Grade 12</h2>
            <div class="grid grid-cols-4 gap-2">
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12A</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12B</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12C</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12D</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12E</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12F</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12G</a>
                <a href="#" class="border-2 border-gray-500 text-gray-600 hover:bg-gray-500 hover:text-white rounded px-4 py-2 text-center font-medium transition">12H</a>
            </div>
        </div>

    </div>
</div>

@endsection