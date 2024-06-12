<div>
    <div class="relative flex items-top justify-center sm:items-center sm:pt-0">
        <section class="max-w-7xl mx-auto">
            @if($posts->count())
            <header class="text-center">
				@if(isset($filter))
                <h2 class="text-xl font-medium dark:text-white mt-3">{{ $filter }}</h2>
				@endif
            </header>

			<div class="flex flex-row flex-wrap justify-start">
				@foreach ($posts as $post)
					<x-post-card :post="$post" />
				@endforeach
			</div>
            @else
            <header class="text-center py-5 mt-5 mb-3">
                @if(isset($filter))
				<h2 class="text-2xl font-medium dark:text-white mb-3">Ühtegi pilti ei leitud! Proovige oma filtrid lähtestada.</h2>
				<x-link :href="route('posts.index')">Tühjenda filtrid</x-link>
				@else
				<h2 class="text-2xl font-medium dark:text-white mb-3">Ühtegi pilti ei leitud!</h2>
				<x-link :href="route('home')">Värskenda</x-link>
				@endif
            </header>
            @endif
        </section>
    </div>
</div>