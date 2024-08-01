<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\MarkdownConverter;

class ContactsController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $filePath = public_path("storage/{$locale}/contacts.md");
        
        if (!file_exists($filePath)) {
            abort(404, "Contacts file not found for locale: {$locale}");
        }
        
        $markdownContent = file_get_contents(public_path("storage/{$locale}/contacts.md"));
        $converter = new MarkdownConverter($markdownContent);
        $markdown = $converter->toHtml();

        return view('contacts', ['markdown' => $markdown]);
    }
}
