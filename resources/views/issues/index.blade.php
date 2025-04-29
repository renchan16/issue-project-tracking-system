@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">All Issues</h1>
        {{-- Optionally add a general create issue button if needed, but usually created via project --}}
        {{-- @can('create', App\Models\Issue::class)
            <a href="{{ route('issues.create') }}" class="btn btn-primary">
                Create Issue
            </a>
        @endcan --}}
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card animate-on-scroll">
        <div class="card-body p-0"> {{-- Remove padding for full-width table --}}
            <div class="table-responsive"> {{-- Make table responsive --}}
                <table class="table table-striped table-hover mb-0"> {{-- Bootstrap table classes --}}
                    <thead class="table-light"> {{-- Lighter header --}}
                        <tr>
                            <th scope="col" class="ps-3">Title</th>
                            <th scope="col">Project</th>
                            <th scope="col">Status</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Reporter</th>
                            <th scope="col">Assignee</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($issues as $issue)
                            <tr>
                                <td class="ps-3">{{ $issue->title }}</td>
                                <td>
                                    <a href="{{ route('projects.show', $issue->project_id) }}">{{ $issue->project->name }}</a>
                                </td>
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
                                <td colspan="7" class="text-center py-4">No issues found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $issues->links() }} {{-- Pagination links should style correctly now --}}
    </div>
</div>
@endsection 