<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;
use Illuminate\Support\Facades\App; // Import the App facade for locale

class PostTags extends Component
{
    /**
     * @var array $tags to display
     */
    public array $tags;

    /**
     * @var array $tagCategories to display
     */
    public array $tagCategories = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $tags = []) {
        $this->tags = $tags;
        $locale = App::getLocale(); // Get the current locale

        // Match tags with category id to get the category name
        foreach ($this->tags as $tag) {
            $category = Category::find($tag);
            if ($category) {
                // Determine which name to use based on locale
                $categoryName = ($locale === 'en') ? $category->name_en : $category->name;
                
                $this->tagCategories[] = [
                    'tag' => $tag,
                    'categoryName' => $categoryName
                ];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // Pass the tagCategories to the view
        return view('components.post-tags', ['tagCategories' => $this->tagCategories]);
    }
}
