<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    protected $filePath = 'public/storage/en/about.md';

    /**
     * Display the view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Authorize the request
        if (!Gate::allows('access-dashboards')) {
            abort(403);
        }
        
        // Load posts and users based on the user's role
        if ($request->user()->is_admin) {
            $posts = Post::all();
            $users = User::all();
        } elseif ($request->user()->is_author) {
            $posts = $request->user()->posts;
        }

        // Load the content of the markdown file
        $content = File::exists($this->filePath) ? File::get($this->filePath) : '';

        // Return the view with the data we prepared
        return view('dashboard', [
            'posts' => $posts ?? false,
            'users' => $users ?? false,
            'content' => $content,
        ]);
    }

    public function updateMarkdown(Request $request)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string',
        ]);
    
        // Define the path
        $filePath = public_path('storage/en/about.md');
    
        // Ensure the directory exists
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }
    
        // Update the content of the file
        file_put_contents($filePath, $request->input('content'));
    
        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Markdown file updated successfully.');
    }
    
}

