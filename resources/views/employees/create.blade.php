@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-xl font-bold mb-4">Izveidot darbinieku</h1>

    <form method="POST" action="{{ route('employees.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Vārds:</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">E-pasts:</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border" required>
        </div>

        <div class="mb-4">
            <label for="position" class="block text-gray-700">Pozīcija:</label>
            <input type="text" name="position" id="position" class="w-full px-4 py-2 border" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Parole:</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Apstiprini paroli:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700">Loma:</label>
            <select name="role" id="role" class="w-full px-4 py-2 border" required>
                <option value="user">Lietotājs</option>
                <option value="admin">Administrators</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Izveidot</button>
        </div>
    </form>
</div>
@endsection
