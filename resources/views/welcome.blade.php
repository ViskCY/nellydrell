<x-app-layout>
    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="flex flex-col flex-wrap justify-start">
                @foreach($categories as $category)
                    <article class="bg-white rounded-lg shadow-md dark:bg-gray-800 dark:hover:bg-gray-700 m-4 my-5 text-center">
                        <a href="{{ route('posts.index', ['category' => $category->id]) }}">
                            <div class="relative">
                                <span class="rounded-t-lg featured-post-image" role="img" style="background-image: url('{{ $category->background_image }}');" alt="{{ $category->name }}"></span>
                                <span class="absolute text-3xl text-center font-bold text-black" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $category->name }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach

                @livewire('latest-blog-posts')
                
                <div class="px-4 sm:px-6">
                    <a href="{{ route('posts.index') }}" class="rounded-lg text-white px-4 py-5 text-md uppercase font-bold text-center block">
                        {{ __('messages.moreimg') }}
                    </a>
                </div>


            </div>

        </section>
    </div>
</x-app-layout>