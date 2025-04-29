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
        $totalProjects = Project::count();
        $openIssuesCount = Issue::where('status', 'open')->count();
        $myAssignedIssuesCount = Issue::where('assignee_id', $user->id)->where('status', '!= ', 'closed')->count();

        // Recent Activity
        $recentIssues = Issue::with('project')->latest('updated_at')->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        // My Open Issues
        $myOpenIssues = Issue::with('project')
                             ->where('assignee_id', $user->id)
                             ->where('status', 'open')
                             ->latest()
                             ->take(5)
                             ->get();

        return view('home', compact(
            'user',
            'totalProjects',
            'openIssuesCount',
            'myAssignedIssuesCount',
            'recentIssues',
            'recentProjects',
            'myOpenIssues'
        ));
    }
} 