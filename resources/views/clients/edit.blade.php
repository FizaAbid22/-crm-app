<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Client</h2>
            <a href="/clients" class="text-sm text-indigo-600 hover:underline">← Back to Clients</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4">

        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

            {{-- Card header --}}
            <div class="bg-emerald-600 px-6 py-5">
                <h3 class="text-white text-lg font-semibold">Editing: {{ $client->name }}</h3>
                <p class="text-emerald-100 text-sm">Client #{{ $client->id }}</p>
            </div>

            {{-- Form body --}}
            <form action="/clients/{{ $client->id }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ $client->name }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $client->email }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ $client->phone }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                {{-- Form footer --}}
                <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                    <a href="/clients/{{ $client->id }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</a>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-black px-4 py-2 rounded-lg text-sm font-medium">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>