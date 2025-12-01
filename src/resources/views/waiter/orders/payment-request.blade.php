<x-app-layout>
<style>
    [x-cloak] {
        display: none !important;
    }
    
    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .animate-scale-in {
        animation: scaleIn 0.6s ease-out;
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gold-700 leading-tight">
            Fizetési folyamat sikeresen elindítva!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                <div class="p-12 text-center">
                    <div class="mb-8 flex justify-center">
                        <div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center animate-scale-in">
                            <svg class="w-24 h-24 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>


                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Köszönjük, hogy minket választott!
                    </h1>

           
                    <div class="bg-blue-50 border-l-4 border-gold-500 p-6 mb-8">
                        <p class="text-blue-700 text-lg font-medium">
                            Kérjük, várjon míg munkatársunk megérkezik.
                        </p>
                    </div>

                
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <p class="text-gray-600 mb-2">Rendelés összesen:</p>
                        <p class="text-3xl font-bold text-gold-700">
                            {{ number_format($order->total_amount, 0) }} Ft
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>