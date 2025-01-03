<?php

namespace App\Http\Controllers;
use App\Models\ResponseAnswer;
use App\Models\Responses;
use App\Models\Survey;
use App\Models\Answer;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
     public function sent_survey()
    {
        $userId = auth()->user()->id; 

        $surveys = Survey::with(['questions.answers'])
            ->get()
            ->map(function ($survey) use ($userId) {
                $responseExists = Responses::where('user_id', $userId)
                    ->where('survey_id', $survey->id)
                    ->exists();

                $survey->response_status = $responseExists ? 1 : 0;

                return $survey;
            });

       
        return view('dashboard', compact('surveys'));
    }


    public function submitSurvey(Request $request, $surveyId)
    {
        
        $response_user = Responses::where('user_id', auth()->user()->id)
            ->where('survey_id', $surveyId)
            ->first();
    
        if ($response_user) {
            return redirect()->route('dashboard');
        }
    
        $answers = $request->input('answers');
        $validAnswers = true;
    
        foreach ($answers as $questionId => $answer) {
            if ($answer['answer_type'] == 0 && is_numeric($answer['answer'])) {
                $answerRecord = Answer::find($answer['answer']);
                if (!$answerRecord) {
                    $validAnswers = false;
                    break;
                }
            }
        }
            if (!$validAnswers) {
            return redirect()->route('dashboard');
        }
    
        $response = Responses::create([
            'survey_id' => $surveyId,
            'user_id' => auth()->user()->id,
        ]);
        foreach ($answers as $questionId => $answer) {

            if ($answer['answer_type'] == 0) {

                ResponseAnswer::create([
                    'response_id' => $response->id,
                    'answer_id' => $answer['answer'],
                    'user_id' => auth()->user()->id,
                    'answer_text' => null,
                    'survey_id' => $surveyId,  
                ]);
                
            } else {
               
                ResponseAnswer::create([
                    'response_id' => $response->id,
                    'answer_id' => null,
                    'user_id' => auth()->user()->id,
                    'answer_text' => $answer['answer'],
                    'survey_id' => $surveyId,  
                ]);
            }
        }
        
    
        return redirect()->route('dashboard');
    }
    
    

    
}
