<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MarkdownConverter;

class AboutController extends Controller
{
    public function index()
    {
        $locale = session('language');
        $markdownContent = file_get_contents(public_path("storage/{$locale}_about.md"));
        $converter = new MarkdownConverter($markdownContent);
        $markdown = $converter->toHtml();

        return view('about', ['markdown' => $markdown]);
    }
}