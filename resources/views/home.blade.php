@extends('layouts.app')

@section('content')
<div class="container">
    <div class="welcome-back-section text-center mb-5">
        <div class="welcome-avatar mb-3">
            <div class="avatar-circle">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        </div>
        <h1 class="welcome-title animate-on-scroll">Welcome back, {{ $user->name }}!</h1>
        <p class="welcome-message animate-on-scroll">Here's a summary of your workspace.</p>
    </div>

    {{-- Summary Cards --}}
    <div class="row mb-4 welcome-stats">
        <div class="col-md-4 mb-3 animate-on-scroll">
            <div class="card stat-item h-100">
                <div class="card-body">
                    <i class="fas fa-folder-open"></i>
                    <h4>Total Projects</h4>
                    <p class="display-6">{{ $totalProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate-on-scroll" style="transition-delay: 0.1s;">
            <div class="card stat-item h-100">
                <div class="card-body">
                    <i class="fas fa-exclamation-circle"></i>
                    <h4>Open Issues</h4>
                    <p class="display-6">{{ $openIssuesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 animate-on-scroll" style="transition-delay: 0.2s;">
            <div class="card stat-item h-100">
                <div class="card-body">
                    <i class="fas fa-user-check"></i>
                    <h4>My Active Issues</h4>
                    <p class="display-6">{{ $myAssignedIssuesCount }}</p>
                    <a href="{{ route('issues.index', ['assignee' => $user->id, 'status' => 'open,in_progress']) }}" class="btn btn-sm btn-outline-primary mt-2">View My Issues</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- My Open Issues --}}
        @can('viewAny', App\Models\Issue::class)
            <div class="col-md-6 mb-4 animate-on-scroll" style="transition-delay: 0.3s;">
                <div class="card h-100">
                    <div class="card-header">
                        My Open Issues
                    </div>
                    <div class="card-body">
                        @if($myOpenIssues->isEmpty())
                            <p class="text-muted">You have no open issues assigned to you.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($myOpenIssues as $issue)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="{{ route('issues.show', $issue->id) }}">{{ $issue->title }}</a>
                                            <small class="d-block text-muted">In: {{ $issue->project->name }}</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ ucfirst($issue->priority) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endcan

        {{-- Recent Issues --}}
        @can('viewAny', App\Models\Issue::class)
            <div class="col-md-{{ Auth::user()->can('viewAny', App\Models\Issue::class) ? '6' : '12' }} mb-4 animate-on-scroll" style="transition-delay: 0.4s;">
                <div class="card h-100">
                    <div class="card-header">
                        Recently Updated Issues
                    </div>
                    <div class="card-body">
                         @if($recentIssues->isEmpty())
                            <p class="text-muted">No recent issue activity.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($recentIssues as $issue)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="{{ route('issues.show', $issue->id) }}">{{ Str::limit($issue->title, 40) }}</a>
                                            <small class="d-block text-muted">In: {{ $issue->project->name }}</small>
                                        </div>
                                        <small class="text-muted">{{ $issue->updated_at->diffForHumans() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endcan
    </div>

    {{-- Recent Projects --}}
    @can('viewAny', App\Models\Project::class)
        <div class="row mt-4">
            <div class="col-12 mb-4 animate-on-scroll" style="transition-delay: 0.5s;">
                <div class="card">
                     <div class="card-header">
                        Recent Projects
                    </div>
                    <div class="card-body">
                         @if($recentProjects->isEmpty())
                            <p class="text-muted">No projects created yet.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($recentProjects as $project)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
                                        <small class="text-muted">Created {{ $project->created_at->diffForHumans() }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endcan

</div>
@endsection 