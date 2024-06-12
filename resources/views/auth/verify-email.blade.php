<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            <img class="fill-current text-gray-500" src="{{ asset('storage/logo.png') }}" alt="Your Image">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
        Täname registreerumast! Kas saaksite enne alustamist oma e-posti aadressi kinnitada, klõpsates lingil, mille just teile meili saatsime? Kui te e-kirja ei saanud, saadame teile hea meelega uue.            {{ __('') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Registreerimisel sisestatud e-posti aadressile on saadetud uus kinnituslink.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Saatke kinnitusmeil uuesti') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Välju') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
