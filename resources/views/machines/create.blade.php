@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Add New Machine</h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('machines.store') }}">
        @csrf

        <!-- Chasis Number -->
        <div class="mb-4">
            <label for="chasis_nr" class="block text-gray-700 font-medium mb-1">Chasis Number:</label>
            <input type="text" name="chasis_nr" id="chasis_nr" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" placeholder="Enter chasis number" required>
        </div>

        <!-- Model -->
        <div class="mb-4">
            <label for="model" class="block text-gray-700 font-medium mb-1">Model:</label>
            <input type="text" name="model" id="model" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" placeholder="Enter model" required>
        </div>

        <!-- Firm -->
        <div class="mb-4">
            <label for="firm" class="block text-gray-700 font-medium mb-1">Firm:</label>
            <input type="text" name="firm" id="firm" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" placeholder="Enter firm" required>
        </div>

        <!-- Motor Hours -->
        <div class="mb-4">
            <label for="motor_hours" class="block text-gray-700 font-medium mb-1">Motor Hours:</label>
            <input type="number" name="motor_hours" id="motor_hours" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" value="0" required>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('machines.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Save Machine
            </button>
        </div>
    </form>
</div>
@endsection
