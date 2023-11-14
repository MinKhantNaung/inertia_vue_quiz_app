<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Answer $answer)
    {
        //
    }

    public function edit(Answer $answer)
    {
        //
    }

    public function update(Request $request, Answer $answer)
    {
        return $answer;
    }

    public function updateAnswers(Request $request) {
        foreach($request->all() as $answer) {
            $updated_answer = Answer::findOrFail($answer['id']);
            $updated_answer->update([
                'name' => $answer['name'],
                'question_id' => $answer['question_id'],
                'is_correct' => $answer['is_correct']
            ]);
        }

        return back();
    }

    public function destroy(Answer $answer)
    {
        //
    }
}
