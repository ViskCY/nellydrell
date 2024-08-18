<article class="w-full sm:w-80 bg-white rounded-lg shadow-md m-4 my-3 flex flex-col flex-grow" style="background-color: #000000;>
    <header>
        <a href="{{ route('posts.show', $post) }}">
            <span class="rounded-t-lg featured-post-image" role="img" style="background-image: url('{{ $post->featured_image }}');" alt="Featured Image"></span>
        </a>
    </header>
    <div class="p-5 h-full flex flex-col">

        @if(config('blog.withTags') && config('blog.showTagsOnPostCard') && $post->tags)
            <x-post-tags :tags="$post->tags" class="text-xs" />
        @endif
                
        <a href="{{ route('posts.show', $post) }}">
            <h3 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white break-words">
                @if($post->isPublished())
                {{ $post->title }}
                @else
                <span class="opacity-75" title="Seda postitust pole veel avaldatud">
                {{__('messages.draft')}}:
                </span>
                <i>{{ $post->title }}</i>
                @endif
            </h3>
        </a>

        <p class="font-normal text-gray-700 dark:text-gray-400 overflow-hidden text-ellipsis">
            {{ $post->description }}
        </p>
        
    </div>
</article>