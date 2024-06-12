<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MarkdownConverter;

class CVController extends Controller
{
    public function index()
    {
        $markdownContent = file_get_contents(public_path('storage/cv.md'));
        $converter = new MarkdownConverter($markdownContent);
        $markdown = $converter->toHtml();

        return view('cv', ['markdown' => $markdown]);
    }
}
