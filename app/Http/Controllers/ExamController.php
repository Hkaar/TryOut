<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\QuestionResult;
use App\Models\Status;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $exams = Exam::paginate(20);

        return view('exams.index', [
            'exams' => $exams,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $exam = Exam::findOrFail($id);
        $user = auth()->user();

        $existing = ExamResult::ByExamId($exam->id)->ByUserId($user->id)->first();

        if ($existing) {
            $questionResults = QuestionResult::ByExamResultId($existing->id)
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
        } else {
            $examResult = ExamResult::create([
                "exam_id" => $exam->id,
                "user_id" => $user->id,
                "start_date" => now(),
            ]);

            $questions = Question::where('packet_id', '=', $exam->packet->id)->inRandomOrder()->get();
            $status = Status::StrictByName('in progress')->first();

            foreach ($questions as $question) {
                QuestionResult::create([
                    'exam_result_id' => $examResult->id,
                    'question_id' => $question->id,
                    'status_id' => $status->id,
                ]);
            }

            $questionResults = QuestionResult::ByExamResultId($examResult->id)
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
        }

        return view('exams.show', [
            'exam' => $exam,
            'questions' => $questionResults,
        ]);
    }

    /**
     * Show the token guard page
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function tokenGuard(int $id)
    {
        // TOKEN NOT IMPLEMENTED YET!
        $exam = Exam::findOrFail($id);

        return view("exams.guard", [
            'exam' => $exam,
        ]);
    }

    /**
     * @return void
     */
    public function checkToken(Request $request, int $id)
    {
        // TOKEN NOT IMPLEMENTED YET!
        // TOKEN FIELD INSIDE EXAM MODEL IS NOT ADDED YET!
    }
}
