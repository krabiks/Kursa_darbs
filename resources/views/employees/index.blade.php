@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Employees</h1>
@endsection

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Employee List</h2>
        <a href="{{ route('employees.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            Add New Employee
        </a>
    </div>

    <table class="w-full border-collapse border border-gray-200 rounded-lg">
        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Position</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr class="hover:bg-gray-100 border-b border-gray-200">
                    <td class="py-3 px-6 text-left">{{ $employee->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $employee->position }}</td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
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
