<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
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

        // Paths to the files
        $files = [
            'en_about' => 'public/storage/en/about.md',
            'en_contacts' => 'public/storage/en/contacts.md',
            'en_cv' => 'public/storage/en/cv.md',
            'et_about' => 'public/storage/et/about.md',
            'et_contacts' => 'public/storage/et/contacts.md',
            'et_cv' => 'public/storage/et/cv.md',
        ];

        // Read the content of each file
        $content = [];
        foreach ($files as $key => $file) {
            if (file_exists($file)) {
                $content[$key] = file_get_contents($file);
            } else {
                $content[$key] = '';
            }
        }

        // Load posts and users based on the user's role
        if ($request->user()->is_admin) {
            $posts = Post::all();
            $users = User::all();
        } elseif ($request->user()->is_author) {
            $posts = $request->user()->posts;
        }

        // Return the view with the data we prepared
        return view('dashboard', [
            'posts' => $posts ?? false,
            'users' => $users ?? false,
            'content' => $content,
        ]);
    }

    public function updateMarkdown(Request $request, $fileKey)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string',
        ]);
    
        // Define the paths to the files
        $filePaths = [
            'en_about' => public_path('storage/en/about.md'),
            'en_contacts' => public_path('storage/en/contacts.md'),
            'en_cv' => public_path('storage/en/cv.md'),
            'et_about' => public_path('storage/et/about.md'),
            'et_contacts' => public_path('storage/et/contacts.md'),
            'et_cv' => public_path('storage/et/cv.md'),
        ];

        // Ensure the directory exists
        if (!isset($filePaths[$fileKey])) {
            abort(404);
        }
        
        $filePath = $filePaths[$fileKey];
    
        // Ensure the directory exists
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }
    
        // Update the content of the file
        file_put_contents($filePath, $request->input('content'));
    
        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Markdowni faili värskendamine õnnestus.');
    }
    
}

