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

            <form action="/deals/{{$deal->id}}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{$deal->title }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="Lead" @selected($deal->status == 'Lead')>Lead</option>
                        <option value="In Progress" @selected($deal->status == 'In Progress')>In Progress</option>
                        <option value="Won" @selected($deal->status == 'Won')>Won</option>
                        <option value="Lost" @selected($deal->status == 'Lost')>Lost</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input type="text" name="amount" value=" {{$deal->amount }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                 <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start-Date</label>
                    <input type="date" name="start_date" value="{{ $deal->start_date ? $deal->start_date->format('Y-m-d') : '' }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
             <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due-Date</label>
                    <input type="date" name="due_date" value="{{$deal->due_date ? $deal->due_date->format('Y-m-d') : '' }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assigned Team Members</label>
                    @foreach ($users as $user)
                        <label class="flex items-center gap-2 mb-1">
                            <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                @checked($deal->users->contains($user->id))>
                            {{ $user->name }}
                        </label>
                    @endforeach
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <select name="client_id" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" @selected($deal->client_id == $client->id)>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                    <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                    <a href="/clients" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</a>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Save Deal
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>