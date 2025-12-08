<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gold-700 leading-tight">
                {{ __('Asztalok Kezelése') }}
            </h2>

            <div class="flex items-center gap-3">
                <a href="{{ route('waiter.dashboard') }}" class="inline-flex items-center px-3 py-2 border rounded bg-white hover:bg-gray-50 text-sm font-medium text-gray-700">
                    Asztalok kezelése
                </a>

                <a href="{{ route('waiter.orders.waiting') }}" class="inline-flex items-center gap-2 px-3 py-2 border rounded bg-white hover:bg-gray-50 text-sm font-medium text-gray-700">
                    <span>Fizetések kezelése</span>
                    @if (isset($waitingCount) && $waitingCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium rounded-full bg-red-500 text-white">
                            {{ $waitingCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/main_img.png') }}')">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-md">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg shadow-md">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-lg">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gold-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gold-700 uppercase tracking-wider sm:rounded-tl-lg">
                                Asztal
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gold-700 uppercase tracking-wider">
                                Leírás
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gold-700 uppercase tracking-wider">
                                Státusz
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gold-700 uppercase tracking-wider sm:rounded-tr-lg">
                                Művelet
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($tables as $table)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">

                                <td class="px-6 py-4 whitespace-nowrap @if($loop->last) sm:rounded-bl-lg @endif">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $table->table_number }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        {{ $table->location_description ?? 'Nincs leírás' }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    @switch($table->status)
                                        @case('available')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-green-100 text-green-800">
                                                Szabad
                                            </span>
                                            @break
                                        @case('occupied')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-red-100 text-red-800">
                                                Foglalt
                                            </span>
                                            @break
                                        @case('reserved')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Foglalva
                                            </span>
                                            @break
                                        @case('out_of_service')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-gray-200 text-gray-800">
                                                Szervizen kívül
                                            </span>
                                            @break
                                    @endswitch
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium @if($loop->last) sm:rounded-br-lg @endif">

                                    <div x-data="{ open: false }" class="relative inline-block text-left">

                                        <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                            Művelet
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <div
                                            x-show="open"
                                            @click.away="open = false"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                                            role="menu"
                                            aria-orientation="vertical"
                                            aria-labelledby="menu-button"
                                            tabindex="-1"
                                            style="display: none;"
                                        >
                                            <div class="py-1" role="none">

                                                @if ($table->status !== 'occupied')
                                                <form method="POST" action="{{ route('waiter.tables.makeOccupied', $table) }}" role="menuitem" tabindex="-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type_ ="submit" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                                        Felszolgálás (Foglalt)
                                                    </button>
                                                </form>
                                                @endif

                                                @if ($table->status !== 'reserved')
                                                <form method="POST" action="{{ route('waiter.tables.makeReserved', $table) }}" role="menuitem" tabindex="-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                                        Foglalás (Lefoglalva)
                                                    </button>
                                                </form>
                                                @endif

                                                @if ($table->status !== 'available')
                                                <form method="POST" action="{{ route('waiter.tables.makeAvailable', $table) }}" role="menuitem" tabindex="-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                                        Szabaddá tesz
                                                    </button>
                                                </form>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @empty

                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 sm:rounded-b-lg">
                                    Jelenleg nincsenek asztalok a rendszerben.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
