<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Participant;
use Illuminate\Http\Request;

class ModuleParticipantController extends Controller
{
    /**
     * Display participants enrolled in a module
     */
    public function index(Module $module)
    {
        $participants = $module->participants()->paginate(10);

        return view('module_participants.index', compact('module', 'participants'));
    }

    /**
     * Show form to enroll participants
     */
    public function create(Module $module)
    {
        // Get participants NOT already enrolled
        $participants = Participant::whereDoesntHave('modules', function ($q) use ($module) {
            $q->where('module_id', $module->id);
        })->get();

        return view('module_participants.create', compact('module', 'participants'));
    }

    /**
     * Store enrollment (bulk)
     */
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate([
            'participants'   => 'required|array',
            'participants.*' => 'exists:participants,id',
        ]);

        $module->participants()->syncWithoutDetaching($validated['participants']);

        return redirect()
            ->route('module-participants.index', $module)
            ->with('success', 'Participants enrolled successfully.');
    }

    /**
     * Remove a participant from module
     */
    public function destroy(Module $module, Participant $participant)
    {
        $module->participants()->detach($participant->id);

        return redirect()
            ->route('module-participants.index', $module)
            ->with('success', 'Participant removed successfully.');
    }

    /**
     * Bulk remove participants
     */
    public function bulkDestroy(Request $request, Module $module)
    {
        $request->validate([
            'participants'   => 'required|array',
            'participants.*' => 'exists:participants,id',
        ]);

        $module->participants()->detach($request->participants);

        return back()->with('success', 'Selected participants removed.');
    }
}