@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Edit Employee</h1>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-1">Name:</label>
            <input type="text" name="name" id="name" value="{{ $employee->name }}" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-1">Email:</label>
            <input type="email" name="email" id="email" value="{{ $employee->email }}" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="position" class="block text-gray-700 font-medium mb-1">Position:</label>
            <input type="text" name="position" id="position" value="{{ $employee->position }}" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-1">Password (Leave blank to keep current):</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-medium mb-1">Role:</label>
            <select name="role" id="role" class="w-full px-4 py-2 border rounded focus:ring focus:ring-blue-300">
                <option value="user" {{ $employee->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $employee->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="text-right">
            <a href="{{ route('employees.index') }}" class="inline-block bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded mr-2">
                Cancel
            </a>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Update Employee
            </button>
        </div>
    </form>
</div>
@endsection
