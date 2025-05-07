@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-bold mb-4">Tehnikas kopsavilkums</h1>

    <form method="GET" action="{{ route('summary.index') }}" class="flex space-x-4 mb-6">
        <!-- Datuma no izvēle -->
        <div>
            <label for="from_date" class="block text-sm font-medium text-gray-700">No datuma:</label>
            <input type="date" name="from_date" class="border-gray-300 rounded-md shadow-sm" value="{{ request('from_date') }}">
        </div>

        <!-- Datuma līdz izvēle -->
        <div>
            <label for="to_date" class="block text-sm font-medium text-gray-700">Līdz datumam:</label>
            <input type="date" name="to_date" class="border-gray-300 rounded-md shadow-sm" value="{{ request('to_date') }}">
        </div>

        <div class="self-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filtrēt</button>
        </div>
    </form>

    <!-- Datu tabula -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2">Tehnika</th>
                    <th class="px-4 py-2">Degviela (l)</th>
                    <th class="px-4 py-2">Motorstundas</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($summary as $item)
                    @php
                        $machine = $machines->firstWhere('id', $item->machine_id);
                        $machineName = $machine ? $machine->firm . ' - ' . $machine->model : 'Nezināma vienība';
                    @endphp

                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $machineName }}</td>
                        <td class="px-4 py-2">{{ $item->total_fuel }}</td>
                        <td class="px-4 py-2">{{ $item->total_hours }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center">Nav datu izvēlētajā periodā.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
