@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="h2">{{ $project->name }}</h1>
            <div>
                @can('update', $project)
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning me-2">Edit Project</a>
                @endcan
                @can('create', App\Models\Issue::class)
                    <a href="{{ route('issues.create', ['project_id' => $project->id]) }}" class="btn btn-primary">Add Issue</a>
                @endcan
            </div>
        </div>
        <p class="text-secondary mb-4">{{ $project->description }}</p>
        <p class="text-muted small">Created: {{ $project->created_at->format('M d, Y') }}</p>
    </div>

    <h2 class="h4 mb-3">Issues in this Project</h2>
    <div class="card animate-on-scroll">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Reporter</th>
                            <th scope="col">Assignee</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($project->issues as $issue)
                            <tr>
                                <td class="ps-3">{{ $issue->title }}</td>
                                <td><span class="badge {{ $issue->status == 'open' ? 'bg-success' : ($issue->status == 'in_progress' ? 'bg-warning text-dark' : 'bg-secondary') }}">{{ ucfirst($issue->status) }}</span></td>
                                <td><span class="badge bg-info text-dark">{{ ucfirst($issue->priority) }}</span></td>
                                <td>{{ $issue->reporter->name ?? 'N/A' }}</td>
                                <td>{{ $issue->assignee->name ?? 'Unassigned' }}</td>
                                <td>
                                    @can('view', $issue)
                                        <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-sm btn-outline-info me-1" title="View"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('update', $issue)
                                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $issue)
                                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No issues found for this project.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
            &larr; Back to Projects
        </a>
    </div>
</div>
@endsection 