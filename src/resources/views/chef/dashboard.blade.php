<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szakács oldal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($items->isEmpty())
                        <p>Nincs függőben lévő rendelés.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">
                                        Sorszám
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Termék
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">
                                        Mennyiség
                                    </th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-48">
                                        Státusz
                                    </th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                        Művelet
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($items as $item)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-900 w-20">
                                            {{ $item->order_item_id }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-900">
                                            {{ $item->product->name ?? 'Ismeretlen' }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-900 w-24">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-900 text-center w-48">
                                            @php
                                                $statusLabels = [
                                                    'ordered'   => 'Megrendelve',
                                                    'preparing' => 'Előkészítés alatt',
                                                    'ready'     => 'Kész',
                                                    'served'    => 'Felszolgálva',
                                                    'cancelled' => 'Törölve',
                                                ];
                                                $statusColors = [
                                                    'ordered'   => 'bg-gray-200 text-gray-800',
                                                    'preparing' => 'bg-yellow-200 text-yellow-800',
                                                    'ready'     => 'bg-green-200 text-green-800',
                                                    'served'    => 'bg-blue-200 text-blue-800',
                                                    'cancelled' => 'bg-red-200 text-red-800',
                                                ];
                                                $label = $statusLabels[$item->status] ?? ucfirst($item->status);
                                                $colorClass = $statusColors[$item->status] ?? 'bg-gray-200 text-gray-800';
                                            @endphp

                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded {{ $colorClass }} min-w-[8rem] text-center">
                                                {{ $label }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-2 text-sm text-gray-900 text-center w-40">
                                            @php
                                                $labels = [
                                                    'ordered'   => 'Készítés alatt',
                                                    'preparing' => 'Kész',
                                                    'ready'     => 'Felszolgálva',
                                                    'served'    => '-',
                                                    'cancelled' => 'Törölve',
                                                ];
                                                $buttonLabel = $labels[$item->status] ?? 'Továbbléptetés';
                                            @endphp

                                            @if($item->status !== 'served' && $item->status !== 'cancelled')
                                                <form method="POST"
                                                    action="{{ route('chef.order-items.update-status', $item) }}"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="w-32 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 text-center">
                                                        {{ $buttonLabel }}
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 text-xs">Nincs további lépés</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
