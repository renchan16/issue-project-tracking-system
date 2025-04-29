@extends('layouts.app')

@section('content')
<div class="welcome-back-section">
    <div class="row">
    <div class="col-md-8">
            <h1 class="welcome-title animate__animated animate__fadeIn">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="welcome-message text-muted animate__animated animate__fadeIn animate__delay-1s">
                Here's an overview of your projects and issues
            </p>
        </div>
        <div class="col-md-4 d-flex justify-content-md-end align-items-center">
            @can('create', App\Models\Project::class)
                <a href="{{ route('projects.create') }}" class="btn btn-primary me-2">
                    <i class="fas fa-plus me-2"></i>New Project
                </a>
            @endcan
            @can('create', App\Models\Issue::class)
                <a href="{{ route('issues.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-2"></i>New Issue
                </a>
            @endcan
        </div>
    </div>
</div>

@unless(Auth::user()->isViewer())
<div class="row mb-4">
    <div class="col-md-6 col-xl-3 mb-4 mb-xl-0">
        <div class="card h-100 stat-item animate-on-scroll">
            <div class="card-body text-center">
                <div class="icon-container mb-3">
                    <i class="fas fa-project-diagram fa-2x text-primary"></i>
                </div>
                <h4>Total Projects</h4>
                <div class="display-6">{{ $projectsCount }}</div>
                <p class="text-muted mt-2 mb-0">Active projects in the system</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4 mb-xl-0">
        <div class="card h-100 stat-item animate-on-scroll">
            <div class="card-body text-center">
                <div class="icon-container mb-3">
                    <i class="fas fa-tasks fa-2x text-success"></i>
                </div>
                <h4>Total Issues</h4>
                <div class="display-6">{{ $issuesCount }}</div>
                <p class="text-muted mt-2 mb-0">Issues being tracked</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4 mb-xl-0">
        <div class="card h-100 stat-item animate-on-scroll">
            <div class="card-body text-center">
                <div class="icon-container mb-3">
                    <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                </div>
                <h4>Open Issues</h4>
                <div class="display-6">{{ $openIssuesCount }}</div>
                <p class="text-muted mt-2 mb-0">Issues requiring attention</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card h-100 stat-item animate-on-scroll">
            <div class="card-body text-center">
                <div class="icon-container mb-3">
                    <i class="fas fa-check-circle fa-2x text-info"></i>
                </div>
                <h4>Resolved Issues</h4>
                <div class="display-6">{{ $resolvedIssuesCount }}</div>
                <p class="text-muted mt-2 mb-0">Successfully completed issues</p>
            </div>
        </div>
    </div>
</div>
@endunless

<div class="row">
    @unless(Auth::user()->isViewer())
    <div class="col-lg-8 mb-4">
        <div class="card animate-on-scroll">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-exclamation-circle me-2"></i>Recent Open Issues</span>
                <a href="{{ route('issues.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if (count($openIssues) > 0)
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Project</th>
                                    <th>Priority</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($openIssues as $issue)
                                    <tr>
                                        <td>
                                            <a href="{{ route('issues.show', $issue->id) }}" class="text-decoration-none fw-medium">
                                                {{ $issue->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('projects.show', $issue->project_id) }}" class="text-decoration-none">
                                                {{ $issue->project->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($issue->priority === 'high')
                                                <span class="badge bg-danger">High</span>
                                            @elseif ($issue->priority === 'medium')
                                                <span class="badge bg-warning">Medium</span>
                                            @else
                                                <span class="badge bg-info">Low</span>
                                            @endif
                                        </td>
                                        <td>{{ $issue->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state py-5">
                        <i class="fas fa-clipboard-check text-muted"></i>
                        <h4>No open issues</h4>
                        <p>There are currently no open issues that need attention.</p>
                        @can('create', App\Models\Issue::class)
                            <a href="{{ route('issues.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create New Issue
                            </a>
                        @endcan
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4">
    @else
    <div class="col-lg-12">
    @endunless
        <div class="card animate-on-scroll">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-project-diagram me-2"></i>Your Projects</span>
                <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if (count($projects) > 0)
                    <div class="list-group list-group-flush">
                        @foreach ($projects as $project)
                            <a href="{{ route('projects.show', $project->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 fw-bold">{{ $project->name }}</h6>
                                    <small class="text-muted">{{ $project->issues_count }} issues</small>
                                </div>
                                <span class="badge rounded-pill bg-light text-dark">
                                    {{ $project->issues()->where('status', 'resolved')->count() }} / {{ $project->issues_count }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    @if(count($recentProjects) > 0)
                        <div class="p-4">
                            <h5 class="mb-3">Recent Projects in the System</h5>
                            <div class="list-group list-group-flush">
                                @foreach ($recentProjects as $project)
                                    <a href="{{ route('projects.show', $project->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1 fw-bold">{{ $project->name }}</h6>
                                            <small class="text-muted">Created {{ $project->created_at->diffForHumans() }}</small>
                                        </div>
                                        <i class="fas fa-arrow-right text-muted"></i>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-3 text-center">
                                <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-primary">
                                    View All Projects
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <i class="fas fa-folder-open text-muted"></i>
                            <h4>No projects yet</h4>
                            <p>There are no projects in the system yet.</p>
                            @can('create', App\Models\Project::class)
                                <a href="{{ route('projects.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                                    <i class=" " style="font-size: 1em;"></i> Create New Project
                                </a>
                            @endcan
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 