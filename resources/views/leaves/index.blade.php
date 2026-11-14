<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leaves</h2>
    </x-slot>



 <div class="py-12 max-w-6xl mx-auto px-4">

        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-500 text-sm">{{ $leaves->count() }} total leaves</p>
            <a href="/leave/create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm font-medium">
                + Add Leave
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="p-4">Name</th>
                        <th class="p-4">Start Date</th>
                        <th class="p-4">End Date</th>
                        <th class="p-4">Reason</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($leaves as $leave)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{ $leave->user->name }}</td>
                            <td class="p-4 text-gray-600">{{ $leave->start_date }}</td>
                            <td class="p-4 text-gray-600">{{ $leave->end_date }}</td>
                            <td class="p-4 text-gray-600">{{ $leave->reason }}</td>
                            <td class="p-4">
                            @if (auth()->user()->role == 'admin' && $leave->status == 'pending')
                                <form action="/leave/{{ $leave->id }}/status" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        class="border border-gray-300 rounded-lg p-1 text-sm">
                                        <option value="" disabled selected>Pending</option>
                                        <option value="approved">Approve</option>
                                        <option value="cancelled">Cancel</option>
                                    </select>
                                </form>
                            @else
                                <span class="@if($leave->status == 'approved') bg-green-100 text-green-700
                                            @elseif($leave->status == 'cancelled') bg-red-100 text-red-700
                                            @else bg-amber-100 text-amber-700
                                            @endif px-2 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst($leave->status) }}
                                </span>
                            @endif
                        </td>

                           <td class="p-4">
                            <div class="flex items-center gap-3 text-sm">
                                <a href="/leave/{{ $leave->id }}" class="text-indigo-600 hover:underline">View</a>

                                @if ($leave->user_id == auth()->id() && $leave->status == 'pending')
                                    <a href="/leave/{{ $leave->id }}/edit" class="text-emerald-600 hover:underline">Edit</a>
                                    <form action="/leave/{{ $leave->id }}" method="POST" onsubmit="return confirm('Delete this leave request?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
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










