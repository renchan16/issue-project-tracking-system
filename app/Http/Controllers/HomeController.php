<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Issue;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Summary Counts
        $projectsCount = Project::count();
        $issuesCount = Issue::count();
        $openIssuesCount = Issue::where('status', 'open')->count();
        $resolvedIssuesCount = Issue::whereIn('status', ['resolved', 'closed'])->count();
        $myAssignedIssuesCount = Issue::where('assignee_id', $user->id)->where('status', '!=', 'closed')->count();

        // Recent Activity
        $recentIssues = Issue::with('project')->latest('updated_at')->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        // Open Issues for display
        $openIssues = Issue::with('project')
                         ->where('status', 'open')
                         ->latest()
                         ->take(5)
                         ->get();

        // User's projects
        $projects = Project::withCount('issues')
                        ->whereHas('members', function($query) use ($user) {
                            $query->where('users.id', $user->id);
                        })
                        ->latest()
                        ->take(5)
                        ->get();

        return view('home', compact(
            'user',
            'projectsCount',
            'issuesCount',
            'openIssuesCount',
            'resolvedIssuesCount',
            'myAssignedIssuesCount',
            'recentIssues',
            'recentProjects',
            'openIssues',
            'projects'
        ));
    }
} 