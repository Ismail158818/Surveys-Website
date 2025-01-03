<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Fun_Services\Fun_Admin;
use App\Http\Requests\QuestionnaireRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\ResponseAnswer;
use App\Models\Survey;

use App\Models\Responses;
use GuzzleHttp\Psr7\Response;
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
    if ($request->has('questions') && is_array($request->questions)) {
        foreach ($request->questions as $questionData) {
            if (isset($questionData['text'])) {
                $question = Question::create([
                    'survey_id' => $request->survey_id,
                    'question_text' => $questionData['text']
                ]);

                if (isset($questionData['answers']) && is_array($questionData['answers'])) {
                    foreach ($questionData['answers'] as $answerText) {
                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $answerText
                        ]);
                    }
                } else {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => 'N/A'
                    ]);
                }
            } else {
                return back()->withErrors('Missing question text');
            }
        }
    } else {
        return back()->withErrors('No questions provided');
    }

    return redirect()->back()->with('success', 'Questions and answers have been saved successfully.');
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
        return redirect()->back();
     
    }
    public function admin_page(Request $request)
    {
        $surveys=Survey::all();
        $responses = Responses::with('user')->get();
        if($surveys)
        {
            return view('admin_page',compact('surveys','responses'));
        }

        return view('admin_page');

    }
    public function analysis(Request $request)
{
    $respondents = $request->respondents;
    $surveyId = $request->survey_id;
    if ($surveyId == 1) {
        $firstAnswers = ResponseAnswer::where('user_id', $respondents[0])
            ->where('survey_id', $surveyId)
            ->get();
        $secondAnswers = ResponseAnswer::where('user_id', $respondents[1])
            ->where('survey_id', $surveyId)
            ->get();
        if ($firstAnswers->count() < 9 || $secondAnswers->count() < 9) {
            return redirect()->back()->with('error', 'Insufficient answers provided');
        }
        $processingTimesA = [$firstAnswers[0]->answer_text, $firstAnswers[1]->answer_text, $firstAnswers[2]->answer_text];
        $transferTimesA = [$firstAnswers[3]->answer_text, $firstAnswers[4]->answer_text];
        $skilledWorkersA = $firstAnswers[5]->answer_text;
        $unskilledWorkersA = $firstAnswers[6]->answer_text;
        $skilledWorkerCostA = $firstAnswers[7]->answer_text;
        $unskilledWorkerCostA = $firstAnswers[8]->answer_text;
        $processingTimesB = [$secondAnswers[0]->answer_text, $secondAnswers[1]->answer_text, $secondAnswers[2]->answer_text];
        $transferTimesB = [$secondAnswers[3]->answer_text, $secondAnswers[4]->answer_text];
        $skilledWorkersB = $secondAnswers[5]->answer_text;
        $unskilledWorkersB = $secondAnswers[6]->answer_text;
        $skilledWorkerCostB = $secondAnswers[7]->answer_text;
        $unskilledWorkerCostB = $secondAnswers[8]->answer_text;
        $calculateTotalTime = function ($processingTimes, $transferTimes) {
            $numTasks = count($processingTimes);
            $dpA = array_fill(0, $numTasks, PHP_INT_MAX);
            $dpB = array_fill(0, $numTasks, PHP_INT_MAX);
            $dpA[0] = $processingTimes[0];
            $dpB[0] = $transferTimes[0] + $processingTimes[0];
            for ($i = 1; $i < $numTasks; $i++) {
                $dpA[$i] = min($dpA[$i - 1] + $processingTimes[$i], $dpB[$i - 1] + $transferTimes[$i % count($transferTimes)] + $processingTimes[$i]);
                $dpB[$i] = min($dpB[$i - 1] + $processingTimes[$i], $dpA[$i - 1] + $transferTimes[$i % count($transferTimes)] + $processingTimes[$i]);
            }
            return min($dpA[$numTasks - 1], $dpB[$numTasks - 1]);
        };
        $totalTimeFactoryA = $calculateTotalTime($processingTimesA, $transferTimesA);
        $totalTimeFactoryB = $calculateTotalTime($processingTimesB, $transferTimesB);
        $totalCostFactoryA = ($skilledWorkersA * $skilledWorkerCostA) + ($unskilledWorkersA * $unskilledWorkerCostA);
        $totalCostFactoryB = ($skilledWorkersB * $skilledWorkerCostB) + ($unskilledWorkersB * $unskilledWorkerCostB);
        $timeDifference = abs($totalTimeFactoryA - $totalTimeFactoryB);
        $costDifference = abs($totalCostFactoryA - $totalCostFactoryB);
        $bestFactoryTime = '';
        $reasonTime = '';
        if ($totalTimeFactoryA < $totalTimeFactoryB) {
            $bestFactoryTime = "Factory $respondents[0]";
            $reasonTime = "Factory $respondents[0] is better in terms of processing time by $timeDifference units.";
        } else {
            $bestFactoryTime = "Factory $respondents[1]";
            $reasonTime = "Factory $respondents[1] is better in terms of processing time by $timeDifference units.";
        }
        $bestFactoryCost = '';
        $reasonCost = '';
        if ($totalCostFactoryA < $totalCostFactoryB) {
            $bestFactoryCost = "Factory $respondents[0]";
            $reasonCost = "Factory $respondents[0] is better in terms of cost by $costDifference units.";
        } else {
            $bestFactoryCost = "Factory $respondents[1]";
            $reasonCost = "Factory $respondents[1] is better in terms of cost by $costDifference units.";
        }

        return redirect()->back()->with([
            'success' => 'Analysis completed successfully',
            'bestFactoryTime' => $bestFactoryTime,
            'reasonTime' => $reasonTime,
            'bestFactoryCost' => $bestFactoryCost,
            'reasonCost' => $reasonCost
        ]);
    }         
    elseif ($surveyId == 2) {
        $popSize = 200; $generations = 100; $mutationRate = 0.99; 
        $answerId = ResponseAnswer::where('user_id', $respondents[0])
            ->where('survey_id', $surveyId)
            ->value('answer_id');
        $answer = Answer::where('id', $answerId)->value('answer_text');
        $startCity = $answer; 
        $distances = [
            ["Damascus", "Homs", 162],["Homs", "Tartous", 96],["Tartous", "Latakia", 90],["Hama", "Homs", 50],["Hama", "Aleppo", 150],
            ["Hama", "Tartous", 140],["Hama", "Latakia", 230],["Hama", "Idlib", 120],["Idlib", "Aleppo", 60],["Idlib", "Latakia", 200]
        ];
        foreach ($distances as $distance) {
            $distances[] = [$distance[1], $distance[0], $distance[2]];
        }$cities = ["Damascus", "Aleppo", "Homs", "Tartous", "Latakia", "Hama", "Idlib"];
        function isValidRoute($route, $startCity) {
            if ($startCity == "Damascus" && !in_array("Homs", $route)) {
                return false; 
            }
            if ($startCity == "Aleppo" && !array_intersect($route, ["Idlib", "Hama"])) {
                return false; 
            }return true;
        }
        function calculateDistance($route, $distances, $startCity) {
            if (!isValidRoute($route, $startCity)) {
                return INF;
            }
            $distance = 0;
            for ($i = 0; $i < count($route) - 1; $i++) {
                foreach ($distances as $d) {
                    if (($d[0] === $route[$i] && $d[1] === $route[$i + 1]) || ($d[1] === $route[$i] && $d[0] === $route[$i + 1])) {
                        $distance += $d[2];
                        break;
                    }}} return $distance;
        }
        function createRandomRoute($startCity, $cities) {
            $middleCities = array_diff($cities, ["Damascus", "Latakia", "Aleppo"]);
            $selectedCities = array_rand(array_flip($middleCities), 2); 
            $route = array_merge([$startCity], $selectedCities, ["Latakia"]);
            if (!isValidRoute($route, $startCity)) {
                return createRandomRoute($startCity, $cities);
            }return $route;
        }
        function createInitialPopulation($popSize, $startCity, $cities) {
            $population = [];
            for ($i = 0; $i < $popSize; $i++) {
                $population[] = createRandomRoute($startCity, $cities);
            } return $population;
        }
        function selectParents($population, $startCity, $distances) {
            usort($population, function($a, $b) use ($startCity, $distances) {
                return calculateDistance($a, $distances, $startCity) <=> calculateDistance($b, $distances, $startCity);
            }); return array_slice($population, 0, 2); 
        }
        function crossover($parent1, $parent2) {
            $slicePoint = rand(1, count($parent1) - 2); 
            $child1 = array_merge(array_slice($parent1, 0, $slicePoint), array_diff($parent2, array_slice($parent1, 0, $slicePoint)));
            $child2 = array_merge(array_slice($parent2, 0, $slicePoint), array_diff($parent1, array_slice($parent2, 0, $slicePoint)));
            return [$child1, $child2];
        }
        function mutate($route, $mutationRate) {
            if (rand(0, 100) / 100 < $mutationRate) {
                $i = rand(1, count($route) - 2);
                $j = rand(1, count($route) - 2);
                list($route[$i], $route[$j]) = [$route[$j], $route[$i]];
            }return $route;
        }
        function geneticAlgorithm($popSize, $generations, $mutationRate, $startCity, $cities, $distances) {
            $population = createInitialPopulation($popSize, $startCity, $cities);
            for ($generation = 0; $generation < $generations; $generation++) {
                $parents = selectParents($population, $startCity, $distances);
                $nextGeneration = [];
                for ($i = 0; $i < $popSize / 2; $i++) {
                    list($child1, $child2) = crossover($parents[0], $parents[1]); 
                    $nextGeneration[] = mutate($child1, $mutationRate);
                    $nextGeneration[] = mutate($child2, $mutationRate);
                }
                $population = $nextGeneration;
                $bestRoute = selectParents($population, $startCity, $distances)[0];
                $bestDistance = calculateDistance($bestRoute, $distances, $startCity);
                echo "Generation " . ($generation + 1) . ": Best Route = " . implode(" → ", $bestRoute) . ", Distance = " . $bestDistance . "\n";
            }
            $bestRoute = selectParents($population, $startCity, $distances)[0];
            return [$bestRoute, calculateDistance($bestRoute, $distances, $startCity)];
        }
        list($bestRoute, $bestDistance) = geneticAlgorithm($popSize, $generations, $mutationRate, $startCity, $cities, $distances);
        return redirect()->back()->with([
            'success' => 'Analysis completed successfully',
            'bestRoute' => $bestRoute,
            'bestDistance' => $bestDistance
        ]);
    }
}
}