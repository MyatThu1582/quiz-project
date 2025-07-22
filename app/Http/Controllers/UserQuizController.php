<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Session;

class UserQuizController extends Controller
{
    public function start(Quiz $quiz)
    {
        $limit = 10;
        $sessionKey = 'quiz_random_questions_' . $quiz->id;
        $endTimeKey = 'quiz_end_time_' . $quiz->id;

        // Step 1: Randomize questions
        if (!Session::has($sessionKey)) {
            $quiz->load('questions');
            $randomQuestions = $quiz->questions->shuffle()->take($limit)->pluck('id')->toArray();
            Session::put($sessionKey, $randomQuestions);
            Session::put('question_index_' . $quiz->id, 0);
            Session::forget('quiz_answers_' . $quiz->id);

            // Step 2: Set end time once (NOW + duration)
            $endTime = now()->addMinutes($quiz->duration);
            Session::put($endTimeKey, $endTime);
        }

        // Step 3: Get end time and calculate remaining
        $endTime = Session::get($endTimeKey);
        $remaining = now()->diffInSeconds($endTime, false); // false = return negative if passed
        if ($remaining <= 0) {
            return redirect()->route('user.quiz.result', $quiz->id);
        }

        // Step 4: Get current question
        $questionIds = Session::get($sessionKey, []);
        $questions = Question::whereIn('id', $questionIds)->get();
        $currentQuestionIndex = Session::get('question_index_' . $quiz->id, 0);

        if (empty($questions) || $currentQuestionIndex >= count($questionIds)) {
            return redirect()->route('user.quiz.result', $quiz->id);
        }

        $question = $questions[$currentQuestionIndex];

        return view('user.quiz.take', compact('quiz', 'question', 'currentQuestionIndex', 'remaining'));
    }


    public function submitAnswer(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answer_id' => 'required|exists:answers,id',
            'question_id' => 'required|exists:questions,id',
        ]);

        $questionId = $request->question_id;
        $selectedAnswer = Answer::where('id', $request->answer_id)
                                ->where('question_id', $questionId)
                                ->first();

        if (!$selectedAnswer) {
            return back()->withErrors(['Invalid answer selected for this question.']);
        }

        $isCorrect = $selectedAnswer->is_correct;

        // Store in session
        $answers = Session::get('quiz_answers_' . $quiz->id, []);
        $answers[] = [
            'question_id' => $selectedAnswer->question_id,
            'answer_id' => $selectedAnswer->id,
            'is_correct' => $isCorrect,
        ];
        Session::put('quiz_answers_' . $quiz->id, $answers);

        // Move to next question
        $currentIndex = Session::get('question_index_' . $quiz->id, 0);
        Session::put('question_index_' . $quiz->id, $currentIndex + 1);

        return redirect()->route('user.quiz.start', $quiz->id);
    }


    public function showResult(Quiz $quiz)
    {
        // Get the user's answers from session
        $answers = Session::get('quiz_answers_' . $quiz->id, []);
        $score = collect($answers)->where('is_correct', true)->count();

        // Safely get total questions from session (in case it's missing)
        $questionIds = Session::get('quiz_random_questions_' . $quiz->id, []);
        $totalQuestions = is_array($questionIds) ? count($questionIds) : 0;

        // 🧼 Clear all quiz-related session data
        Session::forget('quiz_answers_' . $quiz->id);
        Session::forget('question_index_' . $quiz->id);
        Session::forget('quiz_random_questions_' . $quiz->id);

        // Fallback: If no questions were found, redirect with error
        if ($totalQuestions === 0) {
            return redirect('/')->with('error', 'Something went wrong. No questions found for this quiz.');
        }

        return view('user.quiz.result', compact('quiz', 'score', 'totalQuestions'));
    }


}
