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

    public function edit(Employee $employee)
    {
        $user = User::where('email', $employee->email)->first();
        return view('employees.edit', compact('employee', 'user'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id . '|unique:users,email,' . $employee->id,
            'position' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $originalEmail = $employee->getOriginal('email');

        // Atjauno darbinieka informāciju
        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'position' => $validated['position'],
            'role' => $validated['role'],
        ]);

        // Atjauno lietotāja kontu
        $user = User::where('email', $originalEmail)->first();
        if ($user) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Darbinieka un konta informācija veiksmīgi atjaunināta!');
    }

    public function destroy(Employee $employee)
    {
        $user = User::where('email', $employee->email)->first();

        if ($user) {
            $user->delete();
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Darbinieks un konts veiksmīgi dzēsti!');
    }
}
