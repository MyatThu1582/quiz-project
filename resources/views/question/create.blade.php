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
                    Create New Question
                </h2>
            </div>

            <a href="{{ route('questions.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-800 rounded-md shadow-sm transition">
                ← Back to Question List
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                <form action="{{ route('questions.store') }}" method="POST">
                    @csrf

                    {{-- Quiz Selection --}}
                    <div class="mb-4">
                        <label for="quiz_id" class="block text-sm font-medium text-gray-700 mb-1">Select Quiz</label>
                        <select name="quiz_id" id="quiz_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                    hover:border-indigo-400 transition duration-200 ease-in-out
                                    px-3 py-2 bg-white cursor-pointer">
                        <option value="" disabled selected>-- Choose Quiz --</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                        @endforeach
                    </select>
                    </div>

                    {{-- Question Text --}}
                    <div class="mb-4">
                        <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                        <textarea name="question" id="question" rows="4" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                        px-4 py-3 resize-none transition duration-200 ease-in-out"
                        >{{ old('question') }}</textarea>
                    </div>


                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-md shadow-sm transition">
                            Save Question
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>