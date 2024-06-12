<x-app-layout>
    <x-slot name="title">
        Lisa pilt
    </x-slot>

    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <div class="max-w-5xl w-full mx-auto sm:px-6 lg:px-8 my-8 sm:my-16">
            <h1 class="text-3xl font-bold dark:text-white mb-8 sm:my-3 text-center sm:text-left">Uue pildi lisamine</h1>
            <section class="bg-white rounded-lg shadow-md dark:bg-gray-800 py-4 px-6 dark:text-white">
				<form action="{{ route('posts.store') }}" method="POST" class="text-gray-900">
                    @csrf

                    <fieldset>
                        <legend class="text-xl font-bold dark:text-white mb-8 sm:my-3 text-center sm:text-left">Üldine Info (Vajalik)</legend>
                        <hr> 

                        <div class="mt-3">
                            <x-label for="title" :value="__('Pealkiri*')" />
                            <x-input id="title" name="title" :value="old('title')" type="text" class="block mt-1 w-full" maxlength="255" required autofocus placeholder="Pildi pealkiri"/>
                            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-3">
                            <x-label for="featured_image" :value="__('Pildi URL*')" />
                            <x-input id="featured_image" name="featured_image" :value="old('featured_image')" type="text" class="block mt-1 w-full" maxlength="255" required placeholder="https://example.org/static/image.jpg"/>
                            @error('featured_image') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        @if(config('blog.easyMDE.enabled'))
                        <x-markdown-editor :draft_id="$draft_id" />
                        @endif
                    </fieldset>
            
                    <fieldset>
                        <legend class="text-xl font-bold dark:text-white mb-8 sm:my-3 text-center sm:text-left">Muu Info (Valikuline)</legend>
                        <hr> 

                        <div class="mt-3">
                            <x-label for="description" :value="__('Suurus')" />
                            <x-input id="description" name="description" :value="old('description')" type="text" class="block mt-1 w-full" maxlength="255" placeholder="100cm x 100cm"/>
                            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        @if(config('blog.withTags'))
                            <livewire:tag-manager />
                        @endif

                        <div class="mt-3">
                            <x-label for="body" :value="__('Kirjeldus (Body)')" />
                            <x-textarea id="body" name="body" class="block mt-1 w-full" placeholder="Pildi kirjeldus/sisu" rows="8">{{ old('body') }}</x-textarea>
                            @error('body') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>        

                        <div class="mt-3">
                            <x-label for="published_at" :value="__('Millal peaks postitus avaldama?')" />
                            <div class="flex flex-row items-center">
                                <div>
                                    <x-input id="published_at" name="published_at" type="datetime-local" class="block mt-1 w-full" value="{{ (old('published_at') === null) ? now()->format('Y-m-d\TH:i') : '' }}" min="1971-01-01T00:00" max="2038-01-09T03:14"/>
                                    @error('published_at') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <x-label for="published_at">
                                <small>Te võite ka <button class="text-indigo-500 dark:text-indigo-300" title="Tühjendage sisestusväli" type="button" role="button" onclick="clearPublishedAtInput()">tühjaks jätta</button>, et salvestada mustandina.</small>
                            </x-label>
                        </div>
                    </fieldset>
            
                    <div class="flex items-center justify-end mt-4 mb-2">
                        <div>
                            <div class="flex flex-row items-center">
                                <x-label class="cursor-pointer" for="is_draft" :value="__('Salvesta mustandina')" title="Salvestab postituse ilma avaldamiskuupäevata, muutes selle peidetuks."/>
                                <x-input id="is_draft" name="is_draft" value="1" :checked="old('is_draft') || isset($post) && $post->published_at === null" type="checkbox" class="block mx-2 cursor-pointer" title="Vajutage ümberlülitamiseks"/>
                            </div>
                            @error('is_draft') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <x-button type="submit" class="ml-4">
                            {{ __('Salvesta') }}
                        </x-button>
                    </div>
                </form>
			</section>
        </div>
    </div>

    @push('scripts')
    <script>
        function clearPublishedAtInput() { 
            document.getElementById('published_at').value = null;
        }
    </script>
    @endpush
</x-app-layout>