<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\MarkdownConverter;

class AboutController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $filePath = public_path("storage/{$locale}/about.md");
        
        if (!file_exists($filePath)) {
            abort(404, "About file not found for locale: {$locale}");
        }
        
        $markdownContent = file_get_contents(public_path("storage/{$locale}/about.md"));
        $converter = new MarkdownConverter($markdownContent);
        $markdown = $converter->toHtml();

        return view('about', ['markdown' => $markdown]);
    }
}

