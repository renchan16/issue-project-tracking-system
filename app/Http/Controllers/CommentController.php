<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Issue $issue)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $issue->comments()->create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('issues.show', $issue->id)
                         ->with('success', 'Comment added successfully.');
    }

    // Destroy method can be added later
    // public function destroy(Comment $comment) { ... }
}
