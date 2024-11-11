<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Fun_Services\Fun_Admin;
use App\Http\Requests\QuestionnaireRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function add_survey(Request $request)
    {
        $survey=Survey::create([
           'title'=>$request->title,
           'description'=>$request->description
        ]);
        return redirect()->back();
    }
    public function add_questions_answers(Request $request)
    {
        foreach ($request->questions as $questionData) {
            $question = Question::create([
                'survey_id' => $request->survey_id,
                'question_text' => $questionData['question_text']
            ]);
    
            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'question_id' => $question->id,
                    'answer_text' => $answerData['answer_text'] 
                ]);
            }
        }
        return redirect()->back();
    }
    

    public function delete(Request $request)
    {
        if($request->staus==0)
        {
            $question=Survey::find($request->id);
            $question->delete();
        }elseif($request->staus==1)
        {
            $question=Question::find($request->id);
            $question->delete();
        }
        else
        {
            $question=Answer::find($request->id);
            $question->delete();
        }
     
    }
    public function admin_page(Request $request)
    {
        $surveys=Survey::all();
        if($surveys)
        {
            return view('admin_page',compact('surveys'));
        }
        return view('admin_page');

    }
   
}
