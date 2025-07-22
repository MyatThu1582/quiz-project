<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>{{ $quiz->title }} | Take Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .answer-card:hover {
            transform: scale(1.02);
            border-color: #a78bfa; /* Tailwind indigo-400 */
            background: #f3e8ff; /* Tailwind violet-100 */
            box-shadow: 0 4px 12px rgb(167 139 250 / 0.3);
        }
        .answer-card input[type="radio"] {
            accent-color: #8b5cf6; /* Tailwind violet-500 */
        }
        .countdown-badge {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            color: white;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 9999px;
            user-select: none;
            font-size: 0.9rem;
            box-shadow: 0 4px 10px rgba(139,92,246,0.6);
        }
        @keyframes pop-in {
            0% { transform: scale(0.95); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .pop-in {
            animation: pop-in 0.4s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center p-6">

    <div class="relative bg-white rounded-2xl shadow-2xl px-10 py-12 max-w-2xl w-full text-center overflow-hidden pop-in">
        {{-- Confetti decorations for vibe --}}
        <div class="absolute -top-10 -right-10 w-36 h-36 bg-yellow-300 rounded-full opacity-30 animate-ping"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-pink-400 rounded-full opacity-20 animate-ping"></div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-indigo-700 select-none flex items-center gap-2">
                ✨ {{ $quiz->title }} - Question {{ $currentQuestionIndex + 1 }}
            </h1>
            <div class="countdown-badge">
                ⏳ <span id="countdown">--.--</span>
            </div>
        </div>

        <div class="mb-6 p-4 bg-purple-50 rounded-xl border-l-4 border-purple-400 text-indigo-800 font-semibold shadow-sm">
            {{ $question->question }}
        </div>

        <form method="POST" action="{{ route('user.quiz.answer', $quiz->id) }}" id="quizForm" class="space-y-4 text-left">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id }}" />
            <input type="hidden" name="current_index" value="{{ $currentQuestionIndex }}" />

            @foreach ($question->answers->shuffle() as $answer)
                <label class="block answer-card transition-all border border-gray-300 bg-white rounded-xl p-4 shadow cursor-pointer flex items-center gap-4 hover:shadow-md">
                    <input type="radio" name="answer_id" value="{{ $answer->id }}" required class="accent-purple-400 w-5 h-4 scale-100" />
                    <span class="text-gray-900 text-base">{{ $answer->answer_text }}</span>
                </label>
            @endforeach

            <div class="flex justify-end">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-4 rounded-full font-bold text-sm shadow-md transition-all duration-300 mt-3 hover:shadow-lg">
                    🎯 Submit Answer
                </button>
            </div>
        </form>
    </div>

    <script>
        let remainingSeconds = {{ (int) floor($remaining ?? 0) }};
        const countdownEl = document.getElementById("countdown");

        function updateCountdown() {
            if (remainingSeconds <= 0) {
                window.location.href = "{{ route('user.quiz.result', $quiz->id) }}";
                return;
            }
            let minutes = Math.floor(remainingSeconds / 60);
            let seconds = remainingSeconds % 60;

            let formattedTime = minutes + '.' + (seconds < 10 ? '0' : '') + seconds;
            countdownEl.textContent = formattedTime;
            remainingSeconds--;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>

</body>
</html>
