@props(['commaseparated' => false])
<ul aria-label="The post has the following {{ __('blog.tags') }}" {{ $attributes->merge(['class' => 'flex flex-row flex-wrap -mx-1']) }}>
	@if($tagCategories)
		@foreach ($tagCategories as $tagCategory)
			<li class="px-1 pb-1">
				<x-link title="{{ __('blog.posts_with_tag', ['tag' => $tagCategory['tag']]) }}" :href="route('posts.index', ['filterByTag' => $tagCategory['tag']])">
					{{ $tagCategory['categoryName'] }}{{ $commaseparated && !$loop->last ? ', ' : ''}}
				</x-link>
			</li>
		@endforeach
	@endif
</ul>