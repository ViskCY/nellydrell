<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MarkdownConverter;

class CVController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $filePath = public_path("storage/{$locale}/cv.md");
        
        if (!file_exists($filePath)) {
            abort(404, "CV file not found for locale: {$locale}");
        }
        
        $markdownContent = file_get_contents(public_path("storage/{$locale}/cv.md"));
        $converter = new MarkdownConverter($markdownContent);
        $markdown = $converter->toHtml();

        return view('cv', ['markdown' => $markdown]);
    }
}
