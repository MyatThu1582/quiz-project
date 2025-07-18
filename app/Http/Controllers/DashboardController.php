<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    $totalUsers = User::count();
    $totalQuizzes = 12;
    $totalQuestions = 53;
    $totalResults = 18;

    $stats = [
        ['label' => 'Total Users', 'value' => $totalUsers ?? 0, 'color' => 'bg-indigo-600', 'icon' => '👥'],
        ['label' => 'Total Quizzes', 'value' => $totalQuizzes ?? 0, 'color' => 'bg-yellow-500', 'icon' => '📝'],
        ['label' => 'Total Questions', 'value' => $totalQuestions ?? 0, 'color' => 'bg-emerald-600', 'icon' => '❓'],
        ['label' => 'Quiz Results', 'value' => $totalResults ?? 0, 'color' => 'bg-pink-600', 'icon' => '📊'],
    ];

    return view('dashboard', compact('stats'));
}
}
