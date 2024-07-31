<x-app-layout>
    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <header class="text-center py-5 mt-5 mb-3">
                <img class="mx-auto dark:text-white" src="{{ asset('storage/logo.png') }}" alt="Alt">
            </header>

            <div class="flex flex-col flex-wrap justify-start">
                @foreach($categories as $category)
                    <article class="bg-white rounded-lg shadow-md dark:bg-gray-800 dark:hover:bg-gray-700 m-4 my-5 text-center">
                        <a href="{{ route('posts.index', ['category' => $category->id]) }}">
                            <div class="relative">
                                <span class="rounded-t-lg featured-post-image" role="img" style="background-image: url('{{ $category->background_image }}'); filter: blur(4px); -webkit-filter: blur(4px);" alt="{{ $category->name }}"></span>
                                <span class="absolute text-3xl text-center font-bold text-gray-700 dark:text-gray-300" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $category->name }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach

                @livewire('latest-blog-posts')
            </div>

        </section>
    </div>
</x-app-layout>