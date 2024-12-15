<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Machine;
use App\Models\Employee;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    public function index()
    {
        $records = Record::with(['machine', 'employee'])->get();
        return view('records.index', compact('records'));
    }

    public function create()
    {
        $machines = Machine::all();
        $employees = Employee::all();
        return view('records.create', compact('machines', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'employee_id' => 'required|exists:employees,id',
            'fuel_amount' => 'required|integer|min:0',
            'work_summary' => 'required|string|max:255',
            'motor_hours_update' => 'required|integer|min:0',
        ]);

        Record::create($validated);

        // Atjaunina motora stundas pie mašīnas
        $machine = Machine::find($validated['machine_id']);
        $machine->motor_hours += $validated['motor_hours_update'];
        $machine->save();

        return redirect()->route('records.index')->with('success', 'Record created successfully!');
    }

    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }

    public function edit(Record $record)
    {
        $machines = Machine::all();
        $employees = Employee::all();
        return view('records.edit', compact('record', 'machines', 'employees'));
    }

    public function update(Request $request, Record $record)
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'employee_id' => 'required|exists:employees,id',
            'fuel_amount' => 'required|integer|min:0',
            'work_summary' => 'required|string|max:255',
            'motor_hours_update' => 'required|integer|min:0',
        ]);

        $record->update($validated);

        return redirect()->route('records.index')->with('success', 'Record updated successfully!');
    }

    public function destroy(Record $record)
    {
        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully!');
    }
}
