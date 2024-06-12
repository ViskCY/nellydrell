<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="fill-current text-gray-500" src="{{ asset('storage/logo.png') }}" alt="Your Image">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Unustasid salasõna? Pole probleemi. Lihtsalt andke meile oma e-posti aadress ja me saadame teile e-kirjaga parooli lähtestamise lingi, mis võimaldab teil valida uue.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email parooli lähtestamise link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
