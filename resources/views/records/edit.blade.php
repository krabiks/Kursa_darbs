@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Edit Record</h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('records.update', $record->id) }}">
        @csrf
        @method('PUT')

        <!-- Employee -->
        <div class="mb-4">
            <label for="employee_id" class="block text-gray-700 font-medium mb-1">Employee:</label>
            <select name="employee_id" id="employee_id" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $record->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Machine -->
        <div class="mb-4">
            <label for="machine_id" class="block text-gray-700 font-medium mb-1">Machine:</label>
            <select name="machine_id" id="machine_id" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
                @foreach ($machines as $machine)
                    <option value="{{ $machine->id }}" {{ $record->machine_id == $machine->id ? 'selected' : '' }}>
                        {{ $machine->model }} - {{ $machine->chasis_nr }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fuel Amount -->
        <div class="mb-4">
            <label for="fuel_amount" class="block text-gray-700 font-medium mb-1">Fuel Used (liters):</label>
            <input type="number" name="fuel_amount" id="fuel_amount" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" value="{{ $record->fuel_amount }}" required>
        </div>

        <!-- Work Summary -->
        <div class="mb-4">
            <label for="work_summary" class="block text-gray-700 font-medium mb-1">Work Summary:</label>
            <textarea name="work_summary" id="work_summary" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" rows="4" required>{{ $record->work_summary }}</textarea>
        </div>

        <!-- Motor Hours Update -->
        <div class="mb-4">
            <label for="motor_hours_update" class="block text-gray-700 font-medium mb-1">Motor Hours Update:</label>
            <input type="number" name="motor_hours_update" id="motor_hours_update" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" value="{{ $record->motor_hours_update }}" required>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2">
            <a href="{{ route('records.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Update Record
            </button>
        </div>
    </form>
</div>
@endsection
