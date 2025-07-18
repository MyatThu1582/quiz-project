<x-app-layout>
    <x-slot name="header">
        <div x-data="{ open: false }" class="flex items-center justify-between">
            <div class="flex items-center gap-3 max-w-xl truncate">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h11M9 21V3m4 18h6a2 2 0 002-2V7a2 2 0 00-2-2h-6" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight truncate" title="{{ $question->question_text }}">
                    Answer Management
                </h2>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('questions.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-800 rounded-md shadow-sm transition">
                    ← Back to Questions
                </a>

                <button @click="open = true"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-md shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>
                    Add Answer
                </button>
            </div>
        </div>
    </x-slot>

    {{-- Question display outside header slot --}}
    <div class="px-16">
        <div class="max-w-7xl mx-auto mt-6 p-6 bg-white rounded-lg border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300 cursor-default select-text">
            <div class="flex items-center space-x-3">
                <span class="inline-block px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full uppercase tracking-wide">Question</span>
                <p class="text-lg font-semibold text-gray-900 truncate" title="{{ $question->question_text }}">
                    {{ $question->question }}
                </p>
            </div>
            <p class="mt-2 text-sm text-gray-600 italic">Manage the answers for the above question here.</p>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-800">
                    <thead class="bg-gray-100 border-b text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Answer</th>
                            <th class="px-6 py-3">Correct?</th>
                            <th class="px-6 py-3">Created At</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($answers as $index => $answer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $answer->answer_text }}</td>
                                <td class="px-6 py-4">
                                    @if($answer->is_correct)
                                        <span class="text-green-600 font-bold">✔ Yes</span>
                                    @else
                                        <span class="text-red-600 font-bold">✘ No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $answer->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('questions.answers.edit', [$answer->question_id, $answer->id]) }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-xs font-medium">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('questions.answers.destroy', [$answer->question_id, $answer->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Delete this answer?')"
                                                class="text-red-600 hover:text-red-900 text-xs font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</x-app-layout>
