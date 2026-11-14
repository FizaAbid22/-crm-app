<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>


        @if(session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
            @endif

            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4">

        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-500 text-sm">{{ $allRecord->count() }} total clients</p>
            <a href="/clients/create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm font-medium">
                + Add Client
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($allRecord as $record)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{ $record->name }}</td>
                            <td class="p-4 text-gray-600">{{ $record->email }}</td>
                            <td class="p-4 text-gray-600">{{ $record->phone }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3 text-sm">
                                    <a href="/clients/{{ $record->id }}" class="text-indigo-600 hover:underline">View</a>
                                    <a href="/clients/{{ $record->id }}/edit" class="text-emerald-600 hover:underline">Edit</a>
                                    <form action="/clients/{{ $record->id }}" method="POST" onsubmit="return confirm('Delete this client?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>