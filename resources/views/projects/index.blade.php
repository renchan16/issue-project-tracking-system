@extends('layouts.app')

@section('content')
<div class="projects-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title animate__animated animate__fadeInUp">Projects</h1>
        <p class="text-muted animate__animated animate__fadeInUp">Manage and track all your projects in one place</p>
    </div>
    <div>
        @can('create', App\Models\Project::class)
            <a href="{{ route('projects.create') }}" class="btn btn-primary animate__animated animate__fadeInRight">
                <i class="fas fa-plus me-2"></i>New Project
            </a>
        @endcan
    </div>
</div>

<div class="card animate-on-scroll">
    <div class="card-body">
        @if(count($projects) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Issues</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>
                                    <a href="{{ route('projects.show', $project->id) }}" class="fw-bold text-decoration-none">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td>{{ Str::limit($project->description, 70) }}</td>
                                <td><span class="badge bg-primary">{{ $project->issues->count() }}</span></td>
                                <td>{{ $project->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @can('update', $project)
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $project)
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                <h3>No projects found</h3>
                <p class="text-muted">Get started by creating your first project</p>
                @can('create', App\Models\Project::class)
                    <a href="{{ route('projects.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-2"></i>Create Project
                    </a>
                @endcan
            </div>
        @endif
    </div>
</div>
@endsection 