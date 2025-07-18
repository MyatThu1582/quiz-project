<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                Edit Question
            </h2>
            <a href="{{ route('questions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium">
                ← Back to Question List
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">

            <form action="{{ route('questions.update', $question->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="quiz_id" class="block text-sm font-medium text-gray-700">Select Quiz</label>
                    <select name="quiz_id" id="quiz_id" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                    hover:border-indigo-400 transition duration-200 ease-in-out
                                    px-3 py-2 bg-white cursor-pointer">
                        <option value="">-- Choose Quiz --</option>
                        @foreach ($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" {{ $question->quiz_id == $quiz->id ? 'selected' : '' }}>
                                {{ $quiz->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="question_text" class="block text-sm font-medium text-gray-700">Question</label>
                    <textarea name="question" id="question_text" rows="4" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                        px-4 py-3 resize-none transition duration-200 ease-in-out   ">{{ old('question_text', $question->question) }}</textarea>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-md shadow-sm transition">
                        Update Question
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
