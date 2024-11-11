<?php

namespace App\Http\Controllers;
use App\Models\ResponseAnswer;
use App\Models\Responses;
use App\Models\Survey;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function sent_survey()
    {
        $surveys = Survey::with(['questions.answers'])->get();
        if($surveys)
        {
            return view('dashboard',compact('surveys'));
        }
        else
        {
            $surveys='null';
            return view('dashboard',compact('surveys'));
        }
    }




  
public function submitSurvey(Request $request, $surveyId)
{
    $survey = Survey::find($surveyId);

    $response = Responses::create([
        'survey_id' => $survey->id,
        'user_id' => auth()->id(),
    ]);

    foreach ($request->answers as $questionId => $answerId) {
        ResponseAnswer::create([
            'response_id' => $response->id,
            'answer_id' => $answerId,
        ]);
    }

    return redirect()->back()->with('message', 'Survey submitted successfully!');
}


    

}
