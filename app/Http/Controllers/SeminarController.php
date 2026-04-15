<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    public function index()
    {
        $seminars = Seminar::latest()->paginate(10);
        return view('seminars.index', compact('seminars'));
    }

    public function create()
    {
        return view('seminars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
        ]);

        Seminar::create($validated);

        return redirect()->route('seminars.index')
            ->with('success', 'Seminar created successfully!');
    }

    public function show(Seminar $seminar)
    {
        return view('seminars.show', compact('seminar'));
    }

    public function edit(Seminar $seminar)
    {
        return view('seminars.edit', compact('seminar'));
    }

    public function update(Request $request, Seminar $seminar)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
        ]);

        $seminar->update($validated);

        return redirect()->route('seminars.index')
            ->with('success', 'Seminar updated successfully!');
    }

    public function destroy(Seminar $seminar)
    {
        $seminar->delete();

        return back()->with('success', 'Seminar deleted successfully!');
    }
}