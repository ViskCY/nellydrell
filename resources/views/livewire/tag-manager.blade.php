<div class="mt-3">
    <x-label for="tags" :value="__('Kategooriad')" />
    {{-- Select a tag --}}
    <div class="flex">
        <select id="tagInput" name="tagInput" wire:model="tagInput" class="rounded-lg w-full sm:w-fit mt-1 mr-3 form-select">
            <option value="">Vali kategooria</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <x-button type="button" class="mt-1" wire:click="addTag" wire:loading.attr="disabled" wire:target="addTag">Lisa</x-button>
    </div>
    <div class="mt-1">
        @error('tagInput') <span class="text-red-500">{{ $message }}</span> @enderror
        @error('tags') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    @if($tags)
    <div class="mt-2">
        <label for="tags" class="dark:text-white">Lisatud kategooriad:</label>
        <ul class="flex -mx-1">
            <!-- Thanks to https://a11y-guidelines.orange.com/en/web/components-examples/tags/ for the help in making this component accessible -->
            @foreach ($tagsArray as $tag)
            <li class="bg-gray-300 dark:bg-gray-500 dark:text-black px-2 py-1 m-1 rounded-lg text-sm">
                <span class="sr-only">{{ $tag }}</span>
                <button type="button" wire:click="removeTag('{{ $tag }}')" title="Eemalda kategooria" aria-label="Eemalda kategooria {{ $tag }} nimekirjast">
                    {{ $tag }}

                    &times;
                </button>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- The actual json input we submit --}}
    <input wire:model="tags" id="tags" name="tags" type="hidden">
</div>