<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        return Inertia::render('Quizes');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function showAllQuizes() {
        $questions = Question::with(['answers' => function($query) {
            $query->inRandomOrder();
        }])->inRandomOrder()->get();

        return Inertia::render('AllQuizes', [
            'questions' => $questions
        ]);
    }

    public function showResult(Request $request) {
        $correct_percentage = ($request->score / $request->totalQuestions) * 100;

        $comment = match(true) {
            $correct_percentage >= 80 && $correct_percentage <= 100 => 'Congratulation !',
            $correct_percentage >= 60 && $correct_percentage <= 79 => 'Impressive !',
            $correct_percentage >= 40 && $correct_percentage <= 59 => 'Almost there !',
            $correct_percentage < 40 => 'Ah Oh !',
            default => 'Well, Why did you reach here?'
        };

        return Inertia::render('Result', [
            'correctPercentage' => $correct_percentage,
            'comment' => $comment
        ]);
    }
}
