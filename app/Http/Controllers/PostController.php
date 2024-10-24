<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\MarkdownConverter;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    
    /**
     * Display a listing of the resource with support for filters.
     * 
     * Does not include pagination at the moment.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locale = App::getLocale();
        $query = $request->get('query');
        
        if ($request->has('category')) {
            return view('post.index', [
                'title' => 'Posts with ' . __('blog.tag') . ' ' . $request->get('category'),
                'filter' => 'Filtered by ' . __('blog.tag') . ' "' . $request->get('category') . '"',
                'posts' => Post::whereJsonContains('tags', $request->get('category'))->get()->map(function($post) use ($locale) {
                    return $this->translatePostTitle($post, $locale); // Adjust post title based on locale
                }),
            ]);
        }

        if ($request->has('author')) {
            $author = User::findOrFail($request->get('author'));
    
            return view('post.index', [
                'title' => 'Posts by ' . $author->name,
                'filter' => 'Filtered by author ' . $author->name,
                'posts' => $author->posts->map(function($post) use ($locale) {
                    return $this->translatePostTitle($post, $locale); // Adjust post title based on locale
                }),
            ]);
        }

        if ($query) {
            $posts = Post::where('title', 'like', "%{$query}%")->get()->map(function($post) use ($locale) {
                return $this->translatePostTitle($post, $locale); // Adjust post title based on locale
            });

            return view('post.index', [
                'title' => 'Search results for ' . $query,
                'filter' => 'Filtered by search query "' . $query . '"',
                'posts' => $posts,
            ]);
        }

        return view('post.index', [
            'posts' => Post::all()->map(function($post) use ($locale) {
                return $this->translatePostTitle($post, $locale); // Adjust post title based on locale
            }),
        ]);
        
    }

    /**
     * Translate post title based on the current locale.
     *
     * @param \App\Models\Post $post
     * @param string $locale
     * @return \App\Models\Post
     */
    protected function translatePostTitle(Post $post, $locale)
    {
        if ($locale === 'en' && $post->title_en) {
            $post->title = $post->title_en; // Use the English title if locale is 'en'
        }
        // Otherwise, keep the default title (in the default locale)
        return $post;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Post::class);
    
        if (config('blog.easyMDE.enabled')) {
            if (!$request->has('draft_id')) {
                return redirect(route('posts.create', ['draft_id' => time()]));
            }
            
            return view('post.create', [
                'draft_id' => $request->get('draft_id'),
            ]);
        }
    
        return view('post.create');
    }
    

    /**
     * Store a new blog post.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // The incoming request is valid and authorized...
    
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Check if post has tags set, and serialize them to array
        if (isset($validated['tags'])) {
            $validated['tags'] = json_decode($validated['tags'], true);
        }

        // Create the post
        return (new CreatesNewPost)->store($request->user(), $validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $locale = App::getLocale(); // Get the current locale
        $post = $this->translatePostTitle($post, $locale); // Adjust post title based on locale

        // Check if $post->body is not null and convert markdown to HTML
        $markdown = $post->body ? (new MarkdownConverter($post->body))->toHtml() : '';

        return view('post.show', [
            'post' => $post,
            'markdown' => $markdown,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        $this->authorize('update', $post);
    
        if (config('blog.easyMDE.enabled')) {
            if (!$request->has('draft_id')) {
                return redirect(route('posts.edit', [
                    'post' => $post,
                    'draft_id' => time(),
                ]));
            }
            
            return view('post.edit', [
                'post' => $post,
                'draft_id' => $request->get('draft_id'),
            ]);
        }
    
        return view('post.edit', ['post' => $post]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // The incoming request is valid and authorized...
    
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Check if post has tags set, and serialize them to array
        if (isset($validated['tags'])) {
            $validated['tags'] = json_decode($validated['tags'], true);
        }

        // Update the post
        $post->update($validated);

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Update the published_at date in the specified resource in storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function publish(Post $post)
    {
        $this->authorize('update', $post);

        $post->published_at = now();
        $post->save();
        return back()->with('success', 'Pilt edukalt avaldatud!');
    }
    
    /**
     * Update the published_at date in the specified resource in storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function unpublish(Post $post)
    {
        $this->authorize('update', $post);

        $post->published_at = null;
        $post->save();
        return back()->with('success', 'Pilt edukalt mitte avaldatud!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back()->with('success', 'Pilt edukalt eemaldatud');
    }
}
