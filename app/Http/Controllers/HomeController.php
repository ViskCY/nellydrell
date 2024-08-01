<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all()->map(function($category) {
            // Get a random post image for the category
            $randomPost = Post::whereJsonContains('tags', $category->id)->inRandomOrder()->first();
            $category->background_image = $randomPost ? $randomPost->image_url : 'default-image.jpg'; // default image if no post found
            return $category;
        });

        return view('welcome', compact('categories'));
    }
}
