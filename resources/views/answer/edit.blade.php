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
                    Edit Answer
                </h2>
            </div>

            <a href="{{ route('questions.answers.index', $answer->question_id) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-800 rounded-md shadow-sm transition">
                ← Back to Answer List
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('questions.answers.update', [$answer->question_id, $answer->id]) }}">
                    @csrf
                    @method('PUT')

                    {{-- Answer Text --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Answer</label>
                        <input type="text" name="answer_text"
                               value="{{ old('answer_text', $answer->answer_text) }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('answer_text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Is Correct Checkbox --}}
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_correct" value="1"
                                   {{ old('is_correct', $answer->is_correct) ? 'checked' : '' }}
                                   class="form-checkbox text-indigo-600">
                            <span class="ml-2 text-sm text-gray-600">Mark as correct answer</span>
                        </label>
                        @error('is_correct') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Update Answer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
