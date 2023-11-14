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
}
