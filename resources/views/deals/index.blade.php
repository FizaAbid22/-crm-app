<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deals</h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4">

        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-500 text-sm"> {{ $deals->total() }} total Deals</p>
            <a href="/deals/create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm font-medium">
                + Add Deals
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="p-4">Title</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Amount</th>
                        <th class="p-4">Start Date</th>
                        <th class="p-4">due Date</th>

                        <th class="p-4">Assiges</th>
                        <th class="p-4">Client Name</th>

                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ( $deals as  $deal)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{$deal->title }}</td>
                            <td class="p-4 text-gray-600">{{ $deal->status }}</td>
                            <td class="p-4 text-gray-600">{{ $deal->amount }}</td>
                            <td class="p-4 text-gray-600">{{ $deal->start_date?->format('Y-m-d') }}</td>
                            <td class="p-4 text-gray-600">{{ $deal->due_date?->format('Y-m-d') }}</td>


                            <td class="p-4 text-gray-600">
                                @foreach ($deal->users as $user)
                                    {{ $user->name }} 
                                @endforeach
                            </td>
                          
                             <td class="p-4 text-gray-600">{{ $deal->users->pluck('name')->join(', ') }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3 text-sm">
                                    <a href="/deals/{{ $deal->id }}" class="text-indigo-600 hover:underline">View</a>
                                    <a href="/deals/{{ $deal->id  }}/edit" class="text-emerald-600 hover:underline">Edit</a>
                                    <form action="/deals/{{$deal->id  }}" method="POST" onsubmit="return confirm('Delete this Deal?')">
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
              <div class="mt-4">
                {{ $deals->links() }}
            </div>
                            
        </div>

    </div>
</x-app-layout>