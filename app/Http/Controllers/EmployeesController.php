<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email|unique:users,email',
            'position' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        // Izveido darbinieku
        $employee = Employee::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'position' => $validated['position'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Izveido lietotāju
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Darbinieks un lietotājs veiksmīgi izveidots!');
    }
}
