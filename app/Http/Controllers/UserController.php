<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search, filter, and sort
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Allowed sorting columns
        $allowedColumns = ['name', 'email', 'role', 'created_at'];
        $sortBy = $request->input('sort_by');

        if (in_array($sortBy, $allowedColumns)) {
            $sortOrder = $request->input('sort_order', 'asc'); // Default to ascending
            $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc'; // Ensure valid order

            $query->orderBy($sortBy, $sortOrder);
        }

        $users = $query->paginate(10);
        $noResults = $users->isEmpty();

        return view('users.index', compact('users', 'noResults'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $data = Hash::make($validated['password']);
        $data = User::create($validated);
        if ($data) {
            // Set success message
            return redirect()->route('users.index')->with('success', 'Congrat!You have create done.');
        } else {
            // Redirect back to the students index page
            return redirect()->redirect()->back()->with('error', 'User created failed.');
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $data = Hash::make($validated['password']);
        $data = $user->update($validated);

        if ($data) {
            // Set success message
            return redirect()->route('users.index')->with('success', 'Congrat!You have updated done.');
        } else {
            // Redirect back to the students index page
            return redirect()->redirect()->back()->with('error', 'User updated failed.');
        }
    }

    public function destroy(User $user)
    {
        if($user->role == 'teacher'){
            $data = $user->teacher()->delete();
        }

        if($user->role =='student'){
            $data = $user->student()->delete();
        }

        $data = $user->delete();
        if ($data) {
            // Set success message
            return redirect()->route('users.index')->with('success', 'Congrat!You have deleted done.');
        } else {
            // Redirect back to the students index page
            return redirect()->redirect()->back()->with('error', 'User deleted failed.');
        }
    }
}

