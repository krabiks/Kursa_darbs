@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Add New Record</h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('records.store') }}">
        @csrf

        <!-- Employee -->
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 font-medium mb-1">Employee:</label>
            <select name="employee_id" id="employee_id" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Machine -->
        <div class="mb-4">
            <label for="machine_id" class="block text-gray-700 font-medium mb-1">Machine:</label>
            <select name="machine_id" id="machine_id" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
                <option value="">Select Machine</option>
                @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}">{{ $machine->model }} - {{ $machine->chasis_nr }}</option>
                @endforeach
            </select>
        </div>

        <!-- Fuel Amount -->
        <div class="mb-4">
            <label for="fuel_amount" class="block text-gray-700 font-medium mb-1">Fuel Used (liters):</label>
            <input type="number" name="fuel_amount" id="fuel_amount" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" placeholder="Enter fuel amount" required>
        </div>

        <!-- Work Summary -->
        <div class="mb-4">
            <label for="work_summary" class="block text-gray-700 font-medium mb-1">Work Summary:</label>
            <textarea name="work_summary" id="work_summary" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" rows="4" placeholder="Enter work summary" required></textarea>
        </div>

        <!-- Motor Hours Update -->
        <div class="mb-4">
            <label for="motor_hours_update" class="block text-gray-700 font-medium mb-1">Motor Hours Update:</label>
            <input type="number" name="motor_hours_update" id="motor_hours_update" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" placeholder="Enter motor hours update" required>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('records.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Save Record
            </button>
        </div>
    </form>
</div>
@endsection
