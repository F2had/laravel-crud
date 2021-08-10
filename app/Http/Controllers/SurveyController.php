<?php

namespace App\Http\Controllers;

use App\Models\survey_template_dtl;
use App\Models\survey_template_hdr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = survey_template_hdr::where('user_id', auth()->id())->get();


        return view('survey.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                "header" => ['required'],
                "code" => ['required', 'unique:survey_template_hdrs,code'],
                "desc" => ['required'],
                "questions" => ['required', 'array']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ]);
            }


            $hashids = new Hashids(bin2hex(random_bytes(12)),  12);
            $survey = survey_template_hdr::create([
                'user_id' =>  auth()->id(),
                'title' => $request->header,
                'code' => $request->code,
                'description' => $request->desc,
                'url' => $hashids->encode(1)
            ]);

            if ($survey) {

                foreach ($request->questions as $question) {

                    survey_template_dtl::create([
                        'hdr_id' => $survey->id,
                        'sequence' => $question['sequence'],
                        'question' => $question['question'],
                        'answer_type' => $question['answerType']
                    ]);
                }
            }


            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = survey_template_hdr::find($id);

        return view('survey.view-questions', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $header = survey_template_hdr::find($id);

        return view('survey.edit', compact('header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "header" => ['required'],
            "code" => ['required', 'unique:survey_template_hdrs,code,' . $request->id],
            "desc" => ['required']
        ]);




        $survey = survey_template_hdr::where('id', $request->id);
        $survey->update([
            'title' => $request->header,
            'code' => $request->code,
            'description' => $request->desc
        ]);

        return redirect()->back()->with('message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        survey_template_hdr::destroy($id);
        return redirect('survey')->with('message', 'Survey Deleted!');
    }

    public function deleteQuestion($id)
    {
        $hdr_id = survey_template_dtl::find($id)->hdr_id;
        $res = survey_template_dtl::destroy($id);
        if ($res) {
            //reset the sequence 
            $hdr_details = survey_template_hdr::find($hdr_id);

            $questions = $hdr_details->details->sortBy('sequence');

            $questions->map(function ($question, $i) {
                $question->update([
                    'sequence' =>  $i + 1
                ]);
            });
        }

        return redirect()->back()->with('message', 'Question Deleted!');
    }

    public function updateQuestionView($id)
    {
        $question = survey_template_dtl::find($id);
        return view('survey.update-question', compact('question'));
    }
    public function updateQuestion(Request $request, $id)
    {


        $request->validate([
            'question' => ['required'],
            'type' => ['required', 'numeric']
        ]);
        $question = survey_template_dtl::find($id);
        $question->update([
            'question' => $request->question,
            'answer_type' => $request->type
        ]);

        return redirect()->back()->with('message', 'Question updated!');
    }

    public function updateIsOpen(Request $request, $id)
    {

        $request->validate([
            'isOpen' => ['required', 'boolean']
        ]);
        $survey = survey_template_hdr::find($id);
        $survey->update([
            'isOpen' => $request->isOpen
        ]);
        return response()->json(['success' => true]);
    }

    public function addQuestions(Request $request)
    {
        $hdr_id = $request->hdr_id;
        foreach ($request->questions as $question) {

            survey_template_dtl::create([
                'hdr_id' => $hdr_id,
                'sequence' => $question['sequence'],
                'question' => $question['question'],
                'answer_type' => $question['answerType']
            ]);
        }

        return response()->json(['success' => true]);
    }
}