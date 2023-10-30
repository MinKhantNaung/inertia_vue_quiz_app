<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        return Inertia::render('Questions');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'questionName' => 'required|unique:questions,name'
        ]);

        $question = Question::create([
            'name' => $request->questionName
        ]);

        foreach($request->answers as $answer) {
            Answer::create([
                'name' => $answer['answer'],
                'question_id' => $question->id,
                'is_correct' => $answer['is_correct']
            ]);
        }

        return back();
    }

    public function show(Question $question)
    {
        //
    }

    public function edit(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
