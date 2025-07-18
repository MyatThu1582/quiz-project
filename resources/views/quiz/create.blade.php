<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                    Create New Quiz
                </h2>
            </div>

            <a href="{{ route('quizzes.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-800 rounded-md shadow-sm transition">
                ← Back to Quiz List
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('quizzes.store') }}">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="p-3 w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Duration --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Duration (minutes)</label>
                        <input type="number" name="duration" min="1" value="{{ old('duration') ?? 10 }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('duration') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Start Time --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Start Time</label>
                        <input type="datetime-local" name="start_time" value="{{ old('start_time') }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('start_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- End Time --}}
                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">End Time</label>
                        <input type="datetime-local" name="end_time" value="{{ old('end_time') }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('end_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Create Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>