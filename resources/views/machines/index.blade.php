@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Machines</h1>
@endsection

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Machine List</h2>
        <a href="{{ route('machines.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            Add New Machine
        </a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200 rounded-lg shadow">
        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">Chasis Number</th>
                <th class="py-3 px-6 text-left">Model</th>
                <th class="py-3 px-6 text-left">Firm</th>
                <th class="py-3 px-6 text-left">Motor Hours</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($machines as $machine)
                <tr class="hover:bg-gray-100 border-b border-gray-200">
                    <td class="py-3 px-6 text-left">{{ $machine->chasis_nr }}</td>
                    <td class="py-3 px-6 text-left">{{ $machine->model }}</td>
                    <td class="py-3 px-6 text-left">{{ $machine->firm }}</td>
                    <td class="py-3 px-6 text-left">{{ $machine->motor_hours }}</td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('machines.edit', $machine->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('machines.destroy', $machine->id) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow"
                                    onclick="return confirm('Are you sure you want to delete this machine?')">
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
