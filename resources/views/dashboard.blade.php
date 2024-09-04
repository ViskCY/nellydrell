<x-app-layout>
    <x-slot name="title">
        Haldur
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">
            <style>
                .EasyMDEContainer .editor-toolbar .fa {
                    color: #000000; /* Set to white for dark backgrounds */
                }
            </style>

            @if(session('success'))
            <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="py-3 px-4 text-green-900">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if($posts)
            <section class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <header class="flex flex-row justify-between items-center">
                        <h3 class="text-xl font-bold mb-5">{{__('messages.paintingmanage')}}</h3>
                        @can('create', App\Models\Post::class)
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mb-5">{{__('messages.addpic')}}</a>
                        @endcan
                    </header>

                    @if($posts)
                    <!-- Desktop Version -->
                    <div class="hidden sm:block overflow-y-auto" style="max-height: 75vh;">
                        <table class="w-full table-auto border-collapse border border-slate-500">
                            <thead>
                                <tr>
                                    <x-th>{{__('messages.author')}}</x-th>
                                    <x-th>{{__('messages.title')}}</x-th>
                                    <x-th>{{__('messages.published')}}</x-th>
                                    <x-th>{{__('messages.actions')}}</x-th>
                                </tr>
                            </thead>
                            <tbody class="text-gray:700 dark:text-gray-300">
                                @foreach ($posts as $post)
                                <tr class="group">
                                    <x-td>
                                        <a href="{{ route('posts.index', ['author' => $post->author]) }}" rel="author" class="hover:text-indigo-500">
                                            {{ $post->author->name }}
                                        </a>
                                    </x-td>
                                    <x-td>
                                        <div class="overflow-hidden text-ellipsis">
                                            <a href="{{ route('posts.show', ['post' => $post]) }}" class="hover:text-indigo-500">
                                                {{ $post->title }}
                                            </a>
                                        </div>
                                    </x-td>
                                    <x-td>
                                        @if($post->isPublished())
                                        <span title="{{ $post->published_at }}">{{ $post->published_at->format('Y-m-d') }}</span>
                                        @else
                                        <span class="rounded-lg bg-gray-400 text-gray-900 px-2 py-1 text-xs uppercase font-bold" title="This post has not yet been published.">{{__('messages.draft')}}</span>
                                        @can('update', $post)
                                        <form action="{{ route('posts.publish', ['post' => $post]) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            <button type="submit" title="Click to publish the post" class="rounded-lg opacity-0 group-hover:opacity-100 transition-opacity bg-green-400 text-green-900 px-2 py-1 text-xs uppercase font-bold">{{__('messages.publish')}}</button>
                                        </form>
                                        @endcan
                                        @endif
                                    </x-td>
                                    <x-td class="text-center">
                                        @can('update', $post)
                                        <a href="{{ route('posts.edit', ['post' => $post]) }}">
                                            {{__('messages.edit')}}
                                        </a>
                                        @endcan
                                        @can('delete', $post)
                                        <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST" class="inline ml-3" onSubmit="return confirm({{__('messages.deleteconfirm')}})">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-red-700">
                                                {{__('messages.delete')}}
                                            </button>
                                        </form>
                                        @endcan
                                    </x-td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Mobile Version -->
                    <div class="sm:hidden overflow-y-auto" style="max-height: 75vh;">
                        <table class="w-full table-auto">
                            @foreach ($posts as $post)
                            <tbody class="text-gray:700 dark:text-gray-300">
                                <tr>
                                    <x-th>{{__('messages.title')}}</x-th>
                                    <x-th class="lg:py-2 text-left">
                                        <a href="{{ route('posts.show', ['post' => $post]) }}" class="hover:text-indigo-500">
                                            {{ $post->title }}
                                        </a>
                                    </x-th>
                                </tr>
                                <tr>
                                    <x-th>{{__('messages.author')}}</x-th>

                                    <x-td>
                                        <a href="{{ route('posts.index', ['author' => $post->author]) }}" rel="author" class="hover:text-indigo-500">
                                            {{ $post->author->name }}
                                        </a>
                                    </x-td>
                                </tr>
                                <tr>
                                    <x-th>{{__('messages.published')}}</x-th>
                                    <x-td>
                                        @if($post->isPublished())
                                        <span title="{{ $post->published_at }}">{{ $post->published_at->format('Y-m-d') }}</span>
                                        @else
                                        <span class="rounded-lg bg-gray-400 text-gray-900 px-2 py-1 text-xs uppercase font-bold" title="This post has not yet been published.">{{__('messages.draft')}}</span>
                                        @can('update', $post)
                                        <form action="{{ route('posts.publish', ['post' => $post]) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            <button type="submit" title="Click to publish the post" class="rounded-lg opacity-0 group-hover:opacity-100 transition-opacity bg-green-400 text-green-900 px-2 py-1 text-xs uppercase font-bold">{{__('messages.publish')}}</button>
                                        </form>
                                        @endcan
                                        @endif
                                    </x-td>
                                </tr>
                                <tr>
                                    <x-th>{{__('messages.actions')}}</x-th>
                                    <x-td>
                                        @can('update', $post)
                                        <a href="{{ route('posts.edit', ['post' => $post]) }}">
                                            {{__('messages.edit')}}
                                        </a>
                                        @endcan
                                        @can('delete', $post)
                                        <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST" class="inline ml-3" onSubmit="return confirm({{__('messages.deleteconfirm')}})">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-red-700">
                                                {{__('messages.delete')}}
                                            </button>
                                        </form>
                                        @endcan
                                    </x-td>
                                </tr>
                                <!-- Spacer Row -->
                                <tr role="none">
                                    <x-td colspan="2">&nbsp;</x-td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    @endif
                </div>
            </section>
            @endif

            @if($users)
            <section class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-5 mt-10">
                <header class="bg-white dark:bg-gray-800">
                   <h3 class="text-xl font-bold mb-5">{{__('messages.usersmanage')}}</h3> 
                </header>

                <!-- Desktop Version -->
                <div class="hidden sm:block overflow-y-auto" style="max-height: 75vh;">
                    <table class="w-full table-auto border-collapse border border-slate-500">
                        <thead>
                            <tr>
                                <x-th>ID</x-th>
                                <x-th>{{__('messages.name')}}</x-th>
                                <x-th>Email</x-th>
                                <x-th>{{__('messages.roles')}}</x-th>
                                <x-th>{{__('messages.actions')}}</x-th>
                            </tr>
                        </thead>
                        <tbody class="text-gray:700 dark:text-gray-300">
                            @foreach ($users as $user)
                            <tr>
                                <x-td>
                                    <a href="{{ route('posts.index', ['author' => $user]) }}" rel="author" class="hover:text-indigo-500">
                                        <small class="opacity-75">#</small>{{ $user->id }}
                                    </a>
                                </x-td>
                                <x-td>
                                    <a href="{{ route('posts.index', ['author' => $user]) }}" rel="author" class="hover:text-indigo-500">
                                        {{ $user->name }}
                                    </a>
                                </x-td>
                                <x-td>
                                    {{ $user->email }}
                                    @if($user->email_verified_at)
                                        <span title="Email Verified">
                                            <!-- Icon by Google Material Icons (License: MIT) -->
                                            <svg class="fill-green-400 inline" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                        </span>
                                    @endif
                                </x-td>
                                <x-td>
                                    <div class="flex flex-row flex-wrap">
                                        @if($user->is_admin)
                                        <span class="rounded-lg bg-orange-400 text-orange-900 px-2 py-1 text-xs uppercase font-bold m-1">Admin</span>                                    
                                        @endif
                                        @if($user->is_author)
                                        <span class="rounded-lg bg-blue-400 text-blue-900 px-2 py-1 text-xs uppercase font-bold m-1">{{__('messages.author')}}</span>                                    
                                        @endif
                                        @if($user->is_banned)
                                        <span class="rounded-lg bg-red-400 text-red-900 px-2 py-1 text-xs uppercase font-bold m-1">{{__('messages.banned')}}</span>                                    
                                        @endif
                                    </div>
                                </x-td>
                                <x-td class="text-center">
                                    <button onclick="openEditUserModal('{{ $user->id }}')">
                                        {{__('messages.manage')}}
                                    </button>
                                </x-td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Mobile Version -->
                <div class="sm:hidden overflow-y-auto" style="max-height: 75vh;">
                    <table class="w-full table-auto">
                        @foreach ($posts as $post)
                        <tbody class="text-gray:700 dark:text-gray-300">
                            <tr>
                                <x-th>{{__('messages.user')}}</x-th>
                                <x-th class="lg:py-2 text-left">
                                    <a href="{{ route('posts.index', ['author' => $user]) }}" rel="author" class="hover:text-indigo-500">
                                        <small class="opacity-75">#</small>{{ $user->id }}
                                        {{ $user->name }}
                                    </a>
                                </x-th>
                            </tr>
                           
                            <tr>
                                <x-th>Email</x-th>
                                <x-td>
                                    <div class="break-all">
                                        {{ $user->email }}
                                        @if($user->email_verified_at)
                                            <span title="Email Verified">
                                                <!-- Icon by Google Material Icons (License: MIT) -->
                                                <svg class="fill-green-400 inline" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                            </span>
                                        @endif
                                    </div>
                                </x-td>
                            </tr>
                            <tr>
                                <x-th>Rollid</x-th>
                                <x-td>
                                    <div class="flex flex-row flex-wrap">
                                        @if($user->is_admin)
                                        <span class="rounded-lg bg-orange-400 text-orange-900 px-2 py-1 text-xs uppercase font-bold m-1">Admin</span>                                    
                                        @endif
                                        @if($user->is_author)
                                        <span class="rounded-lg bg-blue-400 text-blue-900 px-2 py-1 text-xs uppercase font-bold m-1">{{__('messages.author')}}</span>                                
                                        @endif
                                        @if($user->is_banned)
                                        <span class="rounded-lg bg-red-400 text-red-900 px-2 py-1 text-xs uppercase font-bold m-1">{{__('messages.banned')}}</span>                                  
                                        @endif
                                    </div>
                                </x-td>
                            </tr>
                            <tr>
                                <x-th>{{__('messages.actions')}}</x-th>
                             
                                <x-td>
                                    <button onclick="openEditUserModal('{{ $user->id }}')">
                                        {{__('messages.manage')}}
                                    </button>
                                </x-td>
                            </tr>
                            <!-- Spacer Row -->
                            <tr role="none">
                                <x-td colspan="2">&nbsp;</x-td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>

                
            </section>

            <!-- Loop through all the content to create editors for each file -->
            @foreach (['en_about' => 'About (English)', 'en_contacts' => 'Contacts (English)', 'en_cv' => 'CV (English)', 'et_about' => 'Tutvustus (Eesti)', 'et_contacts' => 'Kontaktid (Eesti)', 'et_cv' => 'CV (Eesti)'] as $key => $label)
            <section class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-5">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <header class="mb-4">
                        <h3 class="text-xl font-bold">
                            {{ $label }}
                        </h3>
                    </header>

                    <form method="POST" action="{{ route('dashboard.update', $key) }}">
                        @csrf
                        <div class="mt-3">
                            <textarea id="{{ $key }}" name="content" class="markdown-editor block mt-1 w-full" placeholder="Sisestage oma sisu siia" rows="10">{{ old('content', $content[$key] ?? '') }}</textarea>
                            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-white dark:text-black uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Uuenda
                        </button>
                    </form>
                </div>
            </section>
            @endforeach

            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const editors = document.querySelectorAll('.markdown-editor');
                    editors.forEach((editor) => {
                        new EasyMDE({ 
                            element: editor,
                        });
                    });
                });
            </script>
            @endpush

            @push('scripts')
            <livewire:edit-user-form-modal />

            <script>
                /**
                 * Open the Livewire Edit User Modal
                 * 
                 * @param integer (user) id
                 */
                function openEditUserModal(id) {
                    Livewire.emit('openEditUserModal', id)
                }
            </script>
            @endpush
            @endif
        </div>
    </div>
</x-app-layout>