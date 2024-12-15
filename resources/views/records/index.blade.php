@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Work Records</h1>
@endsection

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Work Records</h2>
        <a href="{{ route('records.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            Add New Record
        </a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200 rounded-lg shadow">
        <thead class="bg-gray-200 text-gray-600 uppercase text-sm">
            <tr>
                <th class="py-3 px-6 text-left">Employee</th>
                <th class="py-3 px-6 text-left">Machine</th>
                <th class="py-3 px-6 text-left">Fuel Used</th>
                <th class="py-3 px-6 text-left">Work Report</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
            @foreach ($records as $record)
                <tr class="hover:bg-gray-100 border-b border-gray-200">
                    <!-- Employee -->
                    <td class="py-3 px-6">{{ $record->employee->name }}</td>
                    
                    <!-- Machine -->
                    <td class="py-3 px-6">{{ $record->machine->model }} - {{ $record->machine->chasis_nr }}</td>
                    
                    <!-- Fuel Used -->
                    <td class="py-3 px-6">{{ $record->fuel_amount }} L</td>
                    
                    <!-- Work Report -->
                    <td class="py-3 px-6">{{ $record->work_summary }}</td>
                    
                    <!-- Actions -->
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('records.edit', $record->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('records.destroy', $record->id) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
