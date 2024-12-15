<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachinesController extends Controller
{
    public function index()
    {
        $machines = Machine::all();
        return view('machines.index', compact('machines'));
    }

    public function create()
    {
        return view('machines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'chasis_nr' => 'required|unique:machines',
            'model' => 'required|string|max:255',
            'firm' => 'required|string|max:255',
            'motor_hours' => 'required|integer|min:0',
        ]);

        Machine::create($validated);

        return redirect()->route('machines.index')->with('success', 'Machine added successfully!');
    }

    public function show(Machine $machine)
    {
        return view('machines.show', compact('machine'));
    }

    public function edit(Machine $machine)
    {
        return view('machines.edit', compact('machine'));
    }

    public function update(Request $request, Machine $machine)
    {
        $validated = $request->validate([
            'chasis_nr' => 'required|unique:machines,chasis_nr,' . $machine->id,
            'model' => 'required|string|max:255',
            'firm' => 'required|string|max:255',
            'motor_hours' => 'required|integer|min:0',
        ]);

        $machine->update($validated);

        return redirect()->route('machines.index')->with('success', 'Machine updated successfully!');
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect()->route('machines.index')->with('success', 'Machine deleted successfully!');
    }
}
