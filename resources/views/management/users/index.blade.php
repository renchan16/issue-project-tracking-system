@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h2 mb-4">User Management</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card animate-on-scroll">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Current Role</th>
                            <th scope="col">Change Role</th>
                            {{-- Add delete action later if needed --}}
                            {{-- <th scope="col">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $u)
                            <tr>
                                <td class="ps-3 align-middle">{{ $u->name }}</td>
                                <td class="align-middle">{{ $u->email }}</td>
                                <td class="align-middle"><span class="badge bg-secondary">{{ ucfirst($u->role) }}</span></td>
                                <td class="align-middle">
                                    @if(Auth::user()->can('update', $u)) {{-- Check policy before showing form --}}
                                        <form action="{{ route('admin.users.updateRole', $u->id) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="form-select form-select-sm me-2" style="width: 150px;">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role }}" {{ $u->role == $role ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                    @else
                                        {{-- Optionally show text or disable form if user cannot update --}}
                                        <span class="text-muted fst-italic">N/A</span>
                                    @endif
                                </td>
                                {{-- Add delete button later --}}
                                {{-- <td class="align-middle">
                                    @if(Auth::user()->can('delete', $u))
                                        <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete user {{ $u->name }}?')">Delete</button>
                                        </form>
                                    @endif
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection 