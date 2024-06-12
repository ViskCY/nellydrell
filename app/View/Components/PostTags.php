<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category; // Import the Category model

class PostTags extends Component
{
    /**
     * @var array $tags do display
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

        // Match tags with category id to get the category name
        foreach ($this->tags as $tag) {
            $category = Category::find($tag);
            if ($category) {
                $this->tagCategories[] = ['tag' => $tag, 'categoryName' => $category->name];
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