<?php

namespace App\Http\Controllers;

use App\Mail\SurveyShare;
use App\Models\survey_response_hdr;
use App\Models\survey_response_dtl;
use App\Models\survey_template_dtl;
use App\Models\survey_template_hdr;
use App\Models\SurveyShareLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use Mail;


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




        $survey = survey_template_hdr::find($request->id);

        $survey->title = $request->header;
        $survey->code = $request->code;
        $survey->description = $request->desc;
        $survey->save();


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

        $question->question = $request->question;
        $question->answer_type = $request->type;
        $question->save();
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

    public function response($url)
    {
        $survey = survey_template_hdr::where('url', $url)->first();
        if (!$survey) return redirect('student');
        $survey->details->sortBy('sequence');

        return view('survey.response', compact('survey'));
    }

    public function storeResponse(Request $request)
    {
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email'],
        ];



        //Create validation rule for each question
        $questionsNo = $request->numberOfQuestions;
        for ($i = 0; $i < $questionsNo; $i++) {
            $question = (string) 'question' . ($i + 1);
            $rules[$question] = ['required'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) return $validator->errors();

        $survey = survey_template_hdr::find($request->surveyID);

        $response_hdr = survey_response_hdr::create([
            'start_date' => date("Y-m-d H:i:s", strtotime($request->start_date)),
            'end_date' => date("Y-m-d H:i:s", strtotime($request->end_date)),
            'name' =>  $request->name,
            'email' =>  $request->email,
            'survey_hdr_id' => $survey->id,
            'survey_code' => $survey->code,
            'survey_description' => $survey->description,
        ]);


        foreach ($survey->details->sortBy('sequence') as $key => $value) {
            $question = 'question' . ($key + 1);

            if ($value->answer_type === 1) {
                survey_response_dtl::create([
                    'hdr_id' => $response_hdr->id,
                    'survey_dtl_id' => $value->id,
                    'question' => $value->question,
                    'answer_type' => $value->answer_type,
                    'response' => $request->$question,
                ]);
            } else {
                survey_response_dtl::create([
                    'hdr_id' => $response_hdr->id,
                    'survey_dtl_id' => $value->id,
                    'question' => $value->question,
                    'answer_type' => $value->answer_type,
                    'response_detail' => $request->$question,
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    public function generateNewLink(Request $request)
    {


        $survey  = survey_template_hdr::find($request->id);

        if (!$survey) return response()->json(['error' => 'survey not found']);

        $hashids = new Hashids(bin2hex(random_bytes(12)),  12);
        $survey->update([
            'url' => $hashids->encode(1)
        ]);

        return response()->json(['success' => true, 'newLink' => $hashids->encode(1)]);
    }

    public function responses($url)
    {
        $survey = survey_template_hdr::where('url', $url)->first();

        $responses = survey_response_hdr::with('answers')->where('survey_hdr_id', '=', $survey->id)->paginate(1);

        if (!$responses->hasPages()) return redirect()->back()->with('error', 'No responses yet.');
        $item  = $responses->items();
        $answer = $item[0];
        $diff = abs(strtotime($answer->end_date) - strtotime($answer->start_date));
        $answer->time_taken = round($diff / 60);

        return view('survey.responses', compact('survey', 'answer', 'responses'));
    }

    public function responsesSummary($url)
    {
        $survey = survey_template_hdr::where('url', $url)->first();


        foreach ($survey->details as $key => $value) {

            $count = array();
            foreach ($value->responses as  $value) {

                // $diff = abs(strtotime($value->end_date) - strtotime($value->start_date));
                // $value->time_taken = round($diff / 60);

                $question = 'question' . ($key + 1);
                if ($survey->details[$key]->answer_type != 3) {

                    if ($value->response) {
                        array_key_exists($value->response, $count) ?  $count[$value->response]++ :
                            $count[$value->response] = 1;
                    } else {
                        array_key_exists($value->response_detail, $count) ?  $count[$value->response_detail]++ :
                            $count[$value->response_detail] = 1;
                    }
                }
            }

            $survey->details[$key]->$question = $count;
        }


        $details = $survey->details;
        $title = $survey->title;
        $code = $survey->code;
        $desc = $survey->description;

        return view('survey.responses-summary', compact('details', 'title', 'code', 'desc'));
    }

    public function share($id)
    {
        $survey = survey_template_hdr::find($id)->first();

        return view('survey.share', compact('survey'));
    }

    public function sendSurvey(Request $request)
    {
        $defaultMessage = ' Dear Students,
                            <br>
                            Please Fill the survey by clicking the button below.
                            <br>
                            Thank you.';
        if ($request->has('id')) {
            $survey = survey_template_hdr::find($request->id);
            $host = $request->getSchemeAndHttpHost();
            $url = $host . '/survey/response/' . $survey->url;
            $title = $survey->title;
            $message = $request->customMessage == 'on' ? $request->message : $defaultMessage;
            $details = [
                'title' => $title,
                'message' => htmlentities($message),
                'url' => $url
            ];

            Mail::to($request->emails)->send(new SurveyShare($details));

            if (Mail::failures()) {
                return response()->json(['error' => 'Error while sending email']);
            }

            foreach ($request->emails as $key => $email) {
                SurveyShareLog::create([
                    'sent_at'  => date('Y-m-d H:i:s'),
                    'sent_to' => $email
                ]);
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Survey not found.']);
    }
}
