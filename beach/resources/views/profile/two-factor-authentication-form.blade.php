// File: resources/views/profile/two-factor-authentication-form.blade.php

<x-layout>
    <x-slot name="title">
        {{ __('Autenticazione a Due Fattori') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Aggiungi un livello di sicurezza aggiuntivo al tuo account utilizzando l\'autenticazione a due fattori.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if (auth()->user()->two_factor_secret)
                {{ __('Hai abilitato l\'autenticazione a due fattori.') }}
            @else
                {{ __('Non hai ancora abilitato l\'autenticazione a due fattori.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Quando l\'autenticazione a due fattori è abilitata, ti verrà richiesta una token sicura e casuale durante l\'autenticazione. Puoi recuperare questo token dall\'applicazione Google Authenticator del tuo telefono.') }}
            </p>
        </div>

        @if (auth()->user()->two_factor_secret)
            {{-- SEZIONE ATTIVATA --}}

            {{-- 1. Stato di Attivazione in Corso (Mostra QR Code per la conferma) --}}
            @if (session('status') == 'two-factor-authentication-enabled')
                <div class="mt-4 font-semibold text-green-600">
                    {{ __('Autenticazione a due fattori abilitata con successo. Esegui la scansione del codice QR.') }}
                </div>

                <div class="mt-4">
                    {{-- Mostra il QR Code --}}
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>

                {{-- Mostra i Recovery Codes (Codici di Recupero) --}}
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Memorizza questi codici di recupero in un gestore di password sicuro. Serviranno per recuperare l\'accesso al tuo account in caso di smarrimento del dispositivo 2FA.') }}
                    </p>
                </div>
                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif

            {{-- 2. Azioni di Gestione (Rigenera Codici o Disattiva) --}}
            <div class="mt-5">
                {{-- Rigenera Codici di Recupero --}}
                <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}" class="mr-3 inline-block">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        {{ __('Rigenera Codici di Recupero') }}
                    </button>
                </form>

                {{-- Disabilita 2FA --}}
                <form method="POST" action="{{ url('user/two-factor-authentication') }}" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                        {{ __('Disabilita') }}
                    </button>
                </form>
            </div>

        @else
            {{-- SEZIONE DISATTIVATA --}}
            <div class="mt-5">
                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        {{ __('Abilita') }}
                    </button>
                </form>
            </div>
        @endif
    </x-slot>
</x-layout>