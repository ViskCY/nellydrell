<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App; // Import the App facade for locale

class HomeController extends Controller
{
    public function index()
    {
        $locale = App::getLocale(); // Get the current locale

        $categories = Category::all()->map(function ($category) use ($locale) {

            // Log the category ID to debug
            \Log::info('Category ID: ' . $category->id);

            // Get a random post image for the category using a raw query
            $randomPostImage = DB::table('posts')
                ->whereJsonContains('tags', json_encode($category->id))
                ->inRandomOrder()
                ->value('featured_image');

            // Log the random post image to debug
            \Log::info('Random Post Image for Category ID ' . $category->id . ': ' . $randomPostImage);

            // Set the name based on the current locale
            if ($locale === 'en') {
                $category->name = $category->name_en;
            }

            $category->background_image = $randomPostImage ?: asset('storage/default.jpg'); // default image if no post found
            return $category;
        });

        return view('welcome', compact('categories'));
    }
}
