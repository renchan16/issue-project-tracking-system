@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4 animate-on-scroll">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">{{ $issue->title }}</h1>
                    <small class="text-muted">
                        In project: <a href="{{ route('projects.show', $issue->project->id) }}">{{ $issue->project->name }}</a>
                    </small>
                </div>
                <div class="d-flex">
                    @can('update', $issue)
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-sm btn-outline-warning me-2">Edit Issue</a>
                    @endcan
                    @can('delete', $issue)
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete Issue</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title mb-3">Description</h5>
            <p class="card-text text-secondary mb-4">{{ $issue->description ?? 'No description provided.' }}</p>

            <hr>

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <dl class="row">
                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8"><span class="badge {{ $issue->status == 'open' ? 'bg-success' : ($issue->status == 'in_progress' ? 'bg-warning text-dark' : 'bg-secondary') }}">{{ ucfirst($issue->status) }}</span></dd>

                        <dt class="col-sm-4">Priority:</dt>
                        <dd class="col-sm-8"><span class="badge bg-info text-dark">{{ ucfirst($issue->priority) }}</span></dd>

                        <dt class="col-sm-4">Assignee:</dt>
                        <dd class="col-sm-8">{{ $issue->assignee->name ?? 'Unassigned' }}</dd>

                        <dt class="col-sm-4">Reporter:</dt>
                        <dd class="col-sm-8">{{ $issue->reporter->name ?? 'N/A' }}</dd>
                    </dl>
                </div>
                <div class="col-md-6 mb-3">
                     <dl class="row">
                        <dt class="col-sm-4">Created:</dt>
                        <dd class="col-sm-8">{{ $issue->created_at->format('M d, Y H:i') }} <small class="text-muted">({{ $issue->created_at->diffForHumans() }})</small></dd>

                        <dt class="col-sm-4">Updated:</dt>
                        <dd class="col-sm-8">{{ $issue->updated_at->format('M d, Y H:i') }} <small class="text-muted">({{ $issue->updated_at->diffForHumans() }})</small></dd>
                     </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- Comments Section --}}
    <div class="mt-5 animate-on-scroll" style="transition-delay: 0.1s;">
        <h3 class="h4 mb-4">Comments</h3>

        {{-- Add Comment Form --}}
        @auth
            <div class="card mb-4">
                <div class="card-body">
                     <h5 class="card-title mb-3">Add a Comment</h5>
                    <form action="{{ route('comments.store', $issue->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="content" id="content" rows="3" class="form-control @error('content') is-invalid @enderror" placeholder="Type your comment here..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Submit Comment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth

        {{-- Display Comments --}}
        <div class="list-group">
            @forelse ($issue->comments as $comment)
                <div class="list-group-item list-group-item-action flex-column align-items-start mb-2 border rounded animate-on-scroll" style="transition-delay: {{ ($loop->index * 0.05) + 0.2 }}s;">
                    <div class="d-flex w-100 justify-content-between mb-1">
                        <h6 class="mb-1">{{ $comment->user->name ?? 'Unknown User' }}</h6>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $comment->content }}</p>
                     {{-- Add Delete button/form later if needed, check policy --}}
                     {{-- @can('delete', $comment)
                         <small><button class="btn btn-link btn-sm text-danger p-0">Delete</button></small>
                     @endcan --}}
                </div>
            @empty
                 <div class="list-group-item"> 
                    <p class="text-muted mb-0">No comments yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('projects.show', $issue->project_id) }}" class="btn btn-secondary me-2">
            &larr; Back to Project
        </a>
        <a href="{{ route('issues.index') }}" class="btn btn-outline-secondary">
            View All Issues
        </a>
    </div>
</div>
@endsection 