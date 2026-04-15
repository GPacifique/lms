<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('instructor')->latest()->paginate(10);

        return view('modules.index', compact('modules'));
    }

    public function create()
    {
        $instructors = User::all();

        return view('modules.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor_id' => 'required|exists:users,id'
        ]);

        Module::create($validated);

        return redirect()->route('modules.index')
            ->with('success', 'Module created successfully!');
    }

    public function edit(Module $module)
    {
        $instructors = User::all();

        return view('modules.edit', compact('module', 'instructors'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor_id' => 'required|exists:users,id'
        ]);

        $module->update($validated);

        return redirect()->route('modules.index')
            ->with('success', 'Module updated successfully!');
    }

    public function destroy(Module $module)
    {
        $module->delete();

        return back()->with('success', 'Module deleted successfully!');
    }
}