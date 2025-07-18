<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class="text-2xl font-bold text-gray-900">
        Welcome back, {{ Auth::user()->name }} 👋
    </h1>
    <p class="mt-2 text-gray-500">Here’s what’s happening in your application today.</p>
</div>

<div class="px-6 py-6 space-y-6">

    {{-- 💎 ADMIN DASHBOARD STATS (4 in a row, Tailwind style) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-4">
        @php
            $stats = [
                ['label' => 'Total Users', 'value' => $totalUsers ?? 0, 'color' => 'bg-indigo-600', 'icon' => '👥'],
                ['label' => 'Total Quizzes', 'value' => $totalQuizzes ?? 0, 'color' => 'bg-yellow-500', 'icon' => '📝'],
                ['label' => 'Total Questions', 'value' => $totalQuestions ?? 0, 'color' => 'bg-emerald-600', 'icon' => '❓'],
                ['label' => 'Quiz Results', 'value' => $totalResults ?? 0, 'color' => 'bg-pink-600', 'icon' => '📊'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="p-4 rounded shadow text-white flex justify-between items-center {{ $stat['color'] }}">
                <div>
                    <div class="text-lg font-bold">{{ $stat['value'] }}</div>
                    <div class="text-sm">{{ $stat['label'] }}</div>
                    <a href="#" class="text-xs underline text-white/80 mt-1 inline-block">More info →</a>
                </div>
                <div class="text-3xl opacity-30">{{ $stat['icon'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- 📊 CHART SECTION BELOW --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-4 shadow rounded">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-gray-800 font-semibold text-sm">Sales Overview</h3>
                <div class="space-x-1">
                    <button class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">Area</button>
                    <button class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">Donut</button>
                </div>
            </div>
            <div class="h-48">
                <canvas id="salesChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <div class="bg-blue-500 p-4 shadow rounded text-white">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-sm">Visitors Map</h3>
                <button class="text-xs bg-blue-700 px-2 py-1 rounded">📅</button>
            </div>
            <div class="h-48 flex items-center justify-center bg-blue-400 rounded">
                <span class="text-white/70 text-sm">[ Map Placeholder ]</span>
            </div>
        </div>
    </div>
</div>



