<?php
// app/Http/Controllers/AnswerController.php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(Question $question)
    {
        $answers = $question->answers()->latest()->get();
        return view('answer.index', compact('answers', 'question'));
    }


    public function create($questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('answer.create', compact('question'));
    }

    public function store(Request $request, $questionId)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        Answer::create([
            'question_id' => $questionId,
            'answer_text' => $request->input('answer'),
            'is_correct' => $request->has('is_correct'),
        ]);

        return redirect()->route('questions.answers.index', $questionId)
            ->with('success', 'Answer created successfully.');
    }


    public function edit($questionId, Answer $answer)
    {
        return view('answer.edit', compact('answer'));
    }


    public function update(Request $request, Question $question, Answer $answer)
    {
        $request->validate([
            'answer_text' => 'required|string',
        ]);

        $answer->update($request->only('answer_text', 'is_correct'));

        return redirect()->route('questions.answers.index', $question->id)
                        ->with('success', 'Answer updated.');
    }


    public function destroy(Answer $answer)
    {
        $answer->delete();
        return back()->with('success', 'Answer deleted.');
    }
}