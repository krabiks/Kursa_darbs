<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Record;
use App\Models\Machine;

class EquipmentSummaryController extends Controller
{
    /**
     * Rāda tehnikas kopsavilkuma skatu ar datuma un gada filtriem.
     */
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Iegūst visas tehnikas vienības izvēlnei
        $machines = Machine::all();

        $query = Record::query();

        if ($fromDate && $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        $summary = $query->select(
            'machine_id',
            DB::raw('SUM(fuel_amount) as total_fuel'),
            DB::raw('SUM(motor_hours_update) as total_hours')
        )
        ->groupBy('machine_id')
        ->get();

        return view('summary.index', compact('summary', 'machines', 'fromDate', 'toDate'));
    }
}
