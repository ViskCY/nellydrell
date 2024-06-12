<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MarkdownConverter;

class ContactsController extends Controller
{
    public function index()
    {
        $markdownContent = file_get_contents(public_path('storage/contacts.md'));
        $converter = new MarkdownConverter($markdownContent);
        $markdown = $converter->toHtml();

        return view('contacts', ['markdown' => $markdown]);
    }
}
