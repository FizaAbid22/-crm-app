<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Client Details</h2>
            <a href="/clients" class="text-sm text-indigo-600 hover:underline">← Back to Clients</a>
        </div>
    </x-slot>
    <div class="py-12 max-w-2xl mx-auto px-4 space-y-6">

    {{-- Client card --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

        <div class="bg-indigo-600 px-6 py-5">
            <h3 class="text-white text-lg font-semibold">{{ $client->name }}</h3>
            <p class="text-indigo-100 text-sm">Client #{{ $client->id }}</p>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <p class="text-xs uppercase text-gray-400">Email</p>
                <p class="text-gray-800">{{ $client->email }}</p>
            </div>
            
            <div>
                <p class="text-xs uppercase text-gray-400">Phone</p>
                <p class="text-gray-800">{{ $client->phone }}</p>
            </div>
            <div>
                <p class="text-xs uppercase text-gray-400">Client Since</p>
                <p class="text-gray-800">{{ $client->created_at->format('d M, Y') }}</p>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
            <a href="/clients/{{ $client->id }}/edit" class="text-emerald-600 hover:underline text-sm">Edit</a>
            <form action="/clients/{{ $client->id }}" method="POST" onsubmit="return confirm('Delete this client?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
            </form>
        </div>
    </div>

    {{-- Deals card --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-semibold text-gray-800">Deals</h3>
            <a href="/deals/create" class="text-sm text-indigo-600 hover:underline">+ Add Deal</a>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse ($client->deals as $deal)
                <div class="px-6 py-3 flex justify-between items-center text-sm">
                    <span class="text-gray-800">{{ $deal->title }}</span>
                    <span class="text-gray-500">{{ $deal->status }}</span>
                    <span class="text-gray-800 font-medium">{{ number_format($deal->amount, 2) }}</span>
                </div>
            @empty
                <p class="px-6 py-4 text-sm text-gray-400">No deals yet for this client.</p>
            @endforelse
        </div>
    </div>

</div>

    
</x-app-layout>