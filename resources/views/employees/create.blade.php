@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Add New Employee</h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('employees.store') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-1">Name:</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="position" class="block text-gray-700 font-medium mb-1">Position:</label>
            <input type="text" name="position" id="position" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('employees.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
