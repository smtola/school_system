<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Fee::query();

        // Search, filter, and sort
        if ($request->has('search')) {
            $query->where('status', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['student_id', 'amount', 'due_date', 'payment_date', 'status'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $fees = $query->paginate(10);
        $noResults = $fees->isEmpty();
        return view('fees.index', compact('fees', 'noResults'));
    }

    public function create()
    {
        $students = Student::all();
        return view('fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'due_date' => 'required|date',
            'payment_date' => 'required|date',
        ]);

        $data = Fee::create($validated);

        if ($data) {
            // Set success message
            return redirect()->route('fees.index')->with('success', 'Congrat!You have create done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry? You have created failed.');
        }
    }

    public function edit(Fee $fee)
    {
        $students = Student::all();
        return view('fees.edit', compact('fee', 'students'));
    }

    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
            'status' => 'required',
            'due_date' => 'required|date',
            'payment_date' => 'required|date',
        ]);

        $data = $fee->update($validated);

        if ($data) {
            // Set success message
            return redirect()->route('fees.index')->with('success', 'Congrat!You have updated done.');
        } else {
            // Redirect back to the students index page
            return redirect()->back()->with('error', 'Sorry? You have updated failed.');
        }
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();

        return back();
    }
}
