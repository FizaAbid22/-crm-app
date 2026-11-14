<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Apply For Leave</h2>
            <a href="/leave" class="text-sm text-indigo-600 hover:underline">← Back to Leaves</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4">

        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

            <div class="bg-indigo-600 px-6 py-5">
                <h3 class="text-white text-lg font-semibold">New Leave</h3>
                <p class="text-indigo-100 text-sm">Enter the Leave's details below</p>
            </div>

            <form action="/leave" method="POST" class="p-6 space-y-5">
                @csrf

                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div> --}}

                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>
            <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reason</label>
                    <input type="text" name="reason" value="{{ old('reason') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @error('reason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
            </div>
             {{-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <input type="name" name="status" value="{{ old('status') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div> --}}
               
       
                        <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4 flex justify-end gap-3 border-t border-gray-100 mt-6">
                    <a href="/leave" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">Cancel</a>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Submit Leave
                    </button>
                </div>

            </form>

        </div>

    </div>
</x-app-layout>