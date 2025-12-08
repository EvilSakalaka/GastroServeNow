<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gold-700 leading-tight">
                Fizetésre váró rendelések
            </h2>
            <a href="{{ route('waiter.dashboard') }}" class="text-sm text-gray-700 hover:underline">Asztalok kezelése</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="divide-y">
                    @forelse($orders as $order)
                        <div class="p-4 flex justify-between items-center">
                            <div>
                                <div class="text-sm text-gray-700">Rendelés: <strong>#{{ $order->order_id }}</strong></div>
                                <div class="text-sm text-gray-500">Asztal: <strong>{{ optional($order->guestSession)->table_number ?? $order->table_number }}</strong></div>
                                <div class="text-sm text-gray-500">Összeg: <strong>{{ number_format($order->total_amount, 0) }} Ft</strong></div>
                                @if($order->payment_method)
                                    <div class="text-sm text-gray-500">Fizetési mód: <strong>{{ strtoupper($order->payment_method) }}</strong></div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('waiter.orders.success', $order) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">
                                    Részletek
                                </a>

                                <form method="POST" action="{{ route('waiter.orders.confirm-payment', $order) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-gold-500 text-white rounded text-sm hover:bg-gold-700">
                                        Kifizetve
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            Nincs fizetésre váró rendelés.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
