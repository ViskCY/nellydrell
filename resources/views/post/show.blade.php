<x-app-layout>
    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

	@push('meta')
	<!-- Blog Post Meta Tags -->
	<meta property="og:title" content="{{ $post->title }}">
	<meta property="og:type" content="article" />
	<meta property="og:description" content="{{ $post->description }}">
	<meta property="og:image" content="{{ $post->featured_image }}">
	<meta property="og:url" content="{{ route('posts.show', ['post' => $post]) }}">
	@if($post->isPublished())
	<meta property="og:article:published_time" content="{{ $post->published_at }}">
	@endif
	@if(config('blog.showUpdatedAt'))
	<meta property="og:article:modified_time " content="{{ $post->updated_at }}">
	@endif
	<meta name="twitter:card" content="summary_large_image">
	<meta name="author" content="{{ $post->author->name }}">
	<meta name="description" content="{{ $post->description }}">
	@if(config('blog.withTags') && $post->tags)
	<meta name="keywords" itemprop="keywords" content="{{ implode(', ', $post->tags) }}">
	@endif
	@if(config('blog.contentLicense.enabled'))
	<meta itemprop="license" content="{{ config('blog.contentLicense.link') }}">
	@endif
	@endpush
	
    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <div class="max-w-5xl w-full mx-auto sm:px-6 lg:px-8 my-8 md:my-16">
            <article itemscope itemtype="http://schema.org/Article" class="bg-white rounded-lg shadow-md dark:bg-gray-800 py-4 px-6 dark:text-white">
				<meta itemprop="identifier" content="{{ $post->slug }}">
				<meta itemprop="url" content="{{ route('posts.show', $post) }}">
				<header role="doc-pageheader" class="mb-5">
					<table class="w-full">
						<thead>
							<tr>
								<th class="text-left">
									@if($post->isPublished())
									<h1 itemprop="headline" class="text-3xl font-bold">{{ $post->title }}</h1>
									@else
									<h1 class="text-3xl font-bold">
										<span class="opacity-75" title="This post has not yet been published">
											{{__('messages.draft')}}: 
										</span>
										<i>{{ $post->title }}</i>
									</h1>
									@endif
								</th>
								<td class="text-right whitespace-nowrap align-top pt-2 pl-5 hidden sm:block">
									@can('update', $post)
									<a href="{{ route('posts.edit', $post) }}" class="my-2 mr-2 opacity-75 hover:opacity-100 transition-opacity">Halda pilti</a>
									@endcan
								</td>
							</tr>
						</thead>
					</table>
					<p class="text-lg" itemprop="description">{{ $post->description }}</p>
					<div aria-label="About the post" role="doc-introduction">
						<ul class="text-sm flex flex-row flex-wrap -mx-1 mt-1 mb-2">
							@if(config('blog.withTags') && $post->tags)
							<li class="mx-1" name="tags">
								<span class="opacity-75">
									{{__('messages.categories')}}:
								</span>
								<x-post-tags :tags="$post->tags" class="inline-flex" itemprop="keywords" :commaseparated="true"/>
							</li>
							@endif
						</ul>
					</div>
					<figure class="rounded-lg overflow-hidden" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
						<meta itemprop="url" content="{{ $post->featured_image }}">
						<img itemprop="image" src="{{ $post->featured_image }}" alt="Featured Image" class="block h-full w-full bg-cover bg-center bg-no-repea">
					</figure>


				</header>
				
				<section itemprop="articleBody" class="prose dark:prose-invert pb-3">
					{!! $markdown !!}
				</section>
			</article>

			<div class="text-center dark:text-white mt-8 sm:hidden">
				@can('update', $post)
				<a href="{{ route('posts.edit', $post) }}" class="my-2 mr-2 opacity-75 hover:opacity-100 transition-opacity">{{__('messages.mngpic')}}</a>
				@endcan
				<a href="/" class="opacity-75 hover:opacity-100 transition-opacity">{{__('messages.back')}}</a>
			</div>

        </div>
    </div>
</x-app-layout>