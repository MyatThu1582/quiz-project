<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>{{ $quiz->title }} | Quiz Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #cfe9f1, #e0f7fa);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .glass-box {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #60a5fa;
            animation: fall 3s ease-in-out forwards;
            z-index: 50;
            border-radius: 2px;
            opacity: 0.8;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }
    </style>
</head>
<body class="flex items-center justify-center px-4 py-12">

@php
    $totalQuestions = $totalQuestions ?? 10;
    $percentage = $score / $totalQuestions;
    $passed = $percentage >= 0.5;
@endphp

@if ($passed)
    {{-- 🎊 Confetti for winner --}}
    @for ($i = 0; $i < 40; $i++)
        <div class="confetti" style="left: {{ rand(0, 100) }}vw; animation-delay: {{ rand(0, 3000) / 1000 }}s; background-color: hsl({{ rand(200, 270) }}, 80%, 70%)"></div>
    @endfor

    <div class="glass-box max-w-xl w-full rounded-3xl p-10 text-center shadow-2xl">
        <div class="text-5xl mb-4 animate-bounce">🎉</div>
        <h2 class="text-3xl font-bold text-blue-800 mb-2">Awesome Job 😎</h2>
        <p class="text-lg text-blue-700 mb-4">You got <strong>{{ $score }}</strong> out of <strong>{{ $totalQuestions }}</strong> questions correct! 💯</p>

        <div class="bg-white bg-opacity-60 p-4 rounded-xl shadow-inner mb-6">
            <p class="text-lg font-medium text-gray-700">Score: <span class="text-green-600 font-bold">{{ round($percentage * 100) }}%</span></p>
        </div>

        <a href="{{ url('/') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition-all duration-300">
            🏠 Back to Home
        </a>
    </div>
@else
    <div class="glass-box max-w-xl w-full rounded-3xl p-10 text-center shadow-xl">
        <div class="text-5xl mb-4">💪</div>
        <h2 class="text-3xl font-bold text-red-700 mb-2">Don’t Give Up</h2>
        <p class="text-lg text-gray-800 mb-4">You answered <strong>{{ $score }}</strong> out of <strong>{{ $totalQuestions }}</strong>. You’re getting there! 🔄</p>

        <div class="bg-white bg-opacity-60 p-4 rounded-xl shadow-inner mb-6">
            <p class="text-lg font-medium text-gray-700">Score: <span class="text-red-600 font-bold">{{ round($percentage * 100) }}%</span></p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ url('/') }}"
               class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-full font-medium transition">
                🏠 Back to Home
            </a>
            <a href="{{ route('user.quiz.start', $quiz->id) }}"
               class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-medium transition">
                🔁 Try Again
            </a>
        </div>
    </div>
@endif

</body>
</html>
