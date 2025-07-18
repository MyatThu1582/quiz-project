<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen">

    <!-- 🎯 Navbar -->
     <nav class="bg-white/80 backdrop-blur-md shadow-md sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        
        <img src="{{ asset('images/logo.jfif') }}" alt="Logo" class="h-12 w-auto shadow-md hover:shadow-indigo-400 transition-shadow duration-300 cursor-pointer" />

        <div class="space-x-6 flex items-center">
          @guest
            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition duration-300 ease-in-out">
              Login
            </a>
            <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition duration-300 ease-in-out">
              Register
            </a>
          @else
            <a href="{{ route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-full text-sm font-semibold shadow-lg transition duration-300 ease-in-out">
              Dashboard
            </a>
          @endguest
        </div>
      </div>
    </nav>

    <!-- 💡 Main -->
    <div class="container mx-auto px-4 mt-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- 🎯 Quiz Card -->
            @foreach($quizzes as $quiz)
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 border border-indigo-100">
                <h3 class="text-xl font-semibold text-indigo-700">🧠 {{ $quiz->title }}</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $quiz->description }}</p>
                <div class="mt-4 text-sm text-gray-500">⏱ Duration: {{ $quiz->duration }} mins</div>
                <a href=""
                    class="inline-block mt-4 bg-indigo-500 text-white px-5 py-2 rounded-full text-sm hover:bg-indigo-700 transition duration-300">
                    Take Quiz
                </a>
            </div>
            @endforeach


        </div>
    </div>

</body>
</html>
