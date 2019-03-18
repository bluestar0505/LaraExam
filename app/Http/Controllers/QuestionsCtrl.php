<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Paper;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Psy\Util\Json;

class QuestionsCtrl extends Controller
{
    public function index($paperId)
    {

        $paper = Paper::find($paperId);
        if (!$paper) return redirect()->back();

        $questions = $paper->questions()
            ->orderBy('points', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->load('user', 'answers', 'answers.childs');
        return view('web.questions.index', compact('paper', 'questions'));
    }

    public function postNewQuestion($paperId, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'question' => 'required',
        ]);
        $paper = Paper::findOrFail($paperId);
        $user = $request->user();

        $question = new Question;
        $question->title = str_limit($request->input('title'), 250, '...');
        $question->question = $request->input('question');
        $question->user_id = $user->id;
        $question->paper_id = $paper->id;
        $question->save();

        $question->subscribers()->attach($user->id);

        return back()->with(['success' => 'Question saved!']);
    }

    public function view($questionId)
    {
        $question = Question::find($questionId);
        if (empty($question)) return redirect(route('catalogue.favorites'));

        $question->load('answers', 'answers.user', 'answers.childs', 'answers.childs.user');
        $answers = $question->answers;
        $paper = $question->paper;

        return view('web.questions.view', compact('question', 'answers', 'paper'));
    }

    public function delete(Request $request, $questionId)
    {
        if ($request->user()->questions()->find($questionId)) {
            Question::destroy($questionId);
        }
        return back();
    }

    public function answerDelete(Request $request, $questionId)
    {
        if ($request->user()->answers()->find($questionId)) {
            Answer::destroy($questionId);
        }
        return back();
    }

    public function postNewAnswer(Request $request)
    {
        $this->validate($request, [
            'question_id' => 'exists:questions,id',
            'parent_answer_id' => 'exists:answers,id',
            'answer' => 'required',
        ]);
        $request->merge(['user_id' => $request->user()->id]);
        $answer = Answer::create($request->all());

        return back()->with(['success' => 'Question saved!', 'answer_id' => $answer->id]);
    }

    public function xhrVoteQuestion($questionId, Request $request)
    {
        $this->validate($request, ['status' => 'required|in:upvote,downvote']);
        $question = Question::findOrFail($questionId);
        $question->vote($request->input('status'));

        $votes = $question->recountPoints();
        return response()->json(['success' => true, 'votes' => $votes]);
    }

    public function xhrVoteAnswer($answerId, Request $request)
    {
        $this->validate($request, ['status' => 'required|in:upvote,downvote']);
        $question = Answer::findOrFail($answerId);
        $question->vote($request->input('status'));

        $votes = $question->recountPoints();
        return response()->json(['success' => true, 'votes' => $votes]);
    }

    public function xhrQuestionSubscribeToggle($questionId, Request $request)
    {
        $qs = Question::find($questionId);
        $result = $qs->subscribers()->toggle($request->user());
        return response()->json($result);
    }
}
