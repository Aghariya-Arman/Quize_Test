<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    // frontend display data
    public function index()
    {
        $questions = User::paginate(1);
        session()->put('questions', $questions);
        return view('welcome', compact('questions'));

        // $questionall = User::all();
        // session()->put('questionsall', $questionall);
    }


    public function questionform()
    {
        return view('panel.question.add');
    }

    public function showquestion()
    {
        $questions = User::all();
        return view('panel.question.list', compact('questions'));
    }

    public function submitque(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'option1' => 'required|max:255',
            'option2' => 'required|max:255',
            'option3' => 'required|max:255',
            'option4' => 'required|max:255',
            'answer' => 'required',
        ]);

        $data = User::create([
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correctAnswer' => $request->answer,
        ]);
        if ($data) {
            return redirect()->route('showquestion')->with('success', 'Question Add Successfuly');
        }
    }

    public function editquestion($id)
    {
        $question = User::find($id);
        return response()->json([
            'status' => 'success',
            'question' => $question,
        ]);
    }

    public function updatequestion(Request $request)
    {
        $qid = $request->input('que_id');
        $request->validate([
            'question' => 'required|max:255',
            'option1' => 'required|max:255',
            'option2' => 'required|max:255',
            'option3' => 'required|max:255',
            'option4' => 'required|max:255',
            'answer' => 'required',
        ]);
        $data = User::find($qid);
        $question = $data->update([
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correctAnswer' => $request->answer,
        ]);
        if ($question) {
            return redirect()->route('showquestion')->with('success', 'Question Update Successfuly');
        } else {
            return redirect()->route('showquestion')->with('error', 'Something went wrong');
        }
    }
    public function removequestion($id)
    {
        $question = User::find($id);
        if ($question->delete()) {
            return redirect()->route('showquestion')->with('success', 'Question Delete Successfuly');
        }
        return redirect()->route('showquestion')->with('error', 'Question Delete Failed');
    }

    public function ckeckans(Request $request)
    {
        $answer = $request->input('answer');
        $question_id = $request->input('questionid');

        //store user answer in session
        $answerall = session()->get('answerall', '[]');
        $answerall[$question_id] = $answer;
        session()->put('answerall', $answerall);

        $question = User::find($question_id);
        $correct = $question->correctAnswer == $answer;

        $correctAnswercount = session()->get('correctAnswer', '0');
        if ($correct) {
            $correctAnswercount++;
            session()->put('correctAnswer', $correctAnswercount);

            return response()->json([
                'status' => 'success',
                'correct' => true,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'correct' => false,
            ]);
        }
    }

    public function result()
    {
        $correctAns = session()->get('correctAnswer', '0');
        $allanswer = session()->get('answerall');
        $skipQuestion = session('skipquestion');

        $allquestions = User::all();

        return view('panel.question.result', compact(['correctAns', 'allanswer', 'allquestions', 'skipQuestion']));
    }

    public function skipquestion(Request $request)
    {
        $id = $request->input('qid');
        $question = User::find($id);

        if ($question) {
            $correctans = $question->correctAnswer;

            $skipQuestion = session()->get('skipquestion', '[]');
            $skipQuestion[$id] = $correctans;

            session()->put('skipquestion',  $skipQuestion);

            return response()->json([
                'status' => 'success',
                'correct' => $correctans,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Question not found',
            ]);
        }
    }
}
