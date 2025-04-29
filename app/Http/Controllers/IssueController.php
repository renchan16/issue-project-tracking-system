<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IssueController extends Controller
{
    public function __construct()
    {
        // Apply policy middleware to all resource methods
        $this->authorizeResource(Issue::class, 'issue');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Authorization handled by authorizeResource
        $issues = Issue::with(['project', 'reporter', 'assignee'])
                       ->latest()
                       ->paginate(15);
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Authorization handled by authorizeResource
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('issues.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Authorization handled by authorizeResource (for create)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'status' => ['required', Rule::in(['open', 'in_progress', 'closed'])],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $validated['reporter_id'] = Auth::id(); // Set reporter to the current user

        Issue::create($validated);

        return redirect()->route('projects.show', $validated['project_id'])
                         ->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        // Authorization handled by authorizeResource
        $issue->load(['project', 'reporter', 'assignee', 'comments.user']);
        return view('issues.show', compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        // Authorization handled by authorizeResource
        $projects = Project::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('issues.edit', compact('issue', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        // Authorization handled by authorizeResource
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'status' => ['required', Rule::in(['open', 'in_progress', 'closed'])],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $issue->update($validated);

        return redirect()->route('issues.show', $issue->id)
                         ->with('success', 'Issue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        // Authorization handled by authorizeResource
        $projectId = $issue->project_id;
        $issue->delete();

        return redirect()->route('projects.show', $projectId)
                         ->with('success', 'Issue deleted successfully.');
    }
}
