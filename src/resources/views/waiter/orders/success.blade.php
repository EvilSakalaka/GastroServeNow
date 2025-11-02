{{-- /resources/views/waiter/orders/success.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gold-700 leading-tight">
            Rendelés megerősítve ({{ $order->guestSession->table_number }}. asztal)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                <div class="p-10 text-center">
                    
                    {{-- Siker Ikon (Zöld pipa) --}}
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    {{-- A KÉRT ÜZENET --}}
                    <h3 class="mt-5 text-2xl font-semibold text-gray-900">
                        Köszönjük a rendelését!
                    </h3>
                    <p class="mt-2 text-lg text-gray-600">
                        Kérem várjon, míg munkatársunk megérkezik.
                    </p>

                    {{-- Navigációs Gombok --}}
                    <div class="mt-8 flex justify-center space-x-4">
                        <a href="{{ route('waiter.dashboard') }}"
                           class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gold-500 hover:bg-gold-700">
                            Vissza az asztalokhoz
                        </a>
                        
                        {{-- Opcionális gomb: Újabb tétel hozzáadása ehhez az asztalhoz --}}
                        <a href="{{ route('waiter.orders.create', $order->guestSession) }}"
                           class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Újabb tétel hozzáadása
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>