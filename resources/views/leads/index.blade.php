
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lead</h2>
    </x-slot>
        @if (session('success'))
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function () {
                    document.getElementById('success-message').remove();
                }, 2000);
            </script>
        @endif
    <div class="py-12 max-w-6xl mx-auto px-4">

        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-500 text-sm">{{ $allLeads->count() }} total Leads</p>
            <a href="/leads/create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm font-medium">
                + Add Lead
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Actions</th>
                        

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($allLeads as $lead)
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{$lead->name }}</td>
                            <td class="p-4 text-gray-600">{{ $lead->email }}</td>
                            <td class="p-4 text-gray-600">{{ $lead->phone }}</td>
                            <td class="p-4 text-gray-600">{{ $lead->status }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3 text-sm">
                                    <a href="/leads/{{ $lead->id }}" class="text-indigo-600 hover:underline">View</a>
                                    <a href="/leads/{{ $lead->id  }}/edit" class="text-emerald-600 hover:underline">Edit</a>

                                    <form action="/leads/{{$lead->id  }}" method="POST" onsubmit="return confirm('Delete this Lead?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>

                                     @if ($lead->client_id)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                            ✓ Client
                                        </span>
                                    @else
                                        <form action="/leads/{{ $lead->id }}/convert" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                                                Convert to Client
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>