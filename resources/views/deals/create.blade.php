<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Deal</h2>
            <a href="/deals" class="text-sm text-indigo-600 hover:underline">← Back to Deals</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4">

        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

            <div class="bg-indigo-600 px-6 py-5">
                <h3 class="text-white text-lg font-semibold">New Deal</h3>
                <p class="text-indigo-100 text-sm">Enter the Deal's details below</p>
            </div>

            <form action="/deals" method="POST" class="p-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="Lead">Lead</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Won">Won</option>
                    <option value="Lost">Lost</option>
                </select>
            </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input type="text" name="amount" value="{{ old('amount') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start-Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
             <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start-Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <select name="client_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="" disabled selected>Select a client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                  <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Assign Team Members</label>
    @foreach ($users as $user)
        <label class="flex items-center gap-2 mb-1">
            <input type="checkbox" name="users[]" value="{{ $user->id }}">
            {{ $user->name }}
        </label>
    @endforeach
    </div>
                                <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                    <a href="/clients" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</a>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-black px-4 py-2 rounded-lg text-sm font-medium">
                        Save Deal
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>