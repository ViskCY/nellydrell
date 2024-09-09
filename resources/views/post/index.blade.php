<x-app-layout>
    <x-slot name="title">
        {{ $title ?? 'Pildid' }}
    </x-slot>

    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($posts->count())
			<div class="flex flex-row flex-wrap justify-start">
				@foreach ($posts as $post)
					<x-post-card :post="$post" />
				@endforeach
			</div>
            @else
            <header class="text-center py-5 mt-5 mb-3">
                @if(isset($filter))
				<h2 class="text-2xl font-medium dark:text-white mb-3">{{__('messages.nopics')}}</h2>
				<x-link :href="route('posts.index')">{{__('messages.emptyf')}}</x-link>
				@else
				<h2 class="text-2xl font-medium dark:text-white mb-3">{{__('messages.nopics')}}</h2>
				<x-link :href="route('home')">{{__('messages.refresh')}}</x-link>
				@endif
            </header>
            @endif
        </section>
    </div>
</x-app-layout>