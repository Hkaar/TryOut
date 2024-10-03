<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\QuestionResult;
use App\Models\Status;
use Carbon\Carbon;
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
        $current = Carbon::parse((string) now());

        $endDate = Carbon::parse($exam->end_date);
        $diff = $endDate->diffInSeconds($current);

        if (($diff/60) <= 0) {
            return redirect()->route('exams.index');
        }

        if ($existing->finished === 1) {
            return redirect()->route('exams.index');
        }

        if ($existing) {
            $existing->last_date = $current;

            $questionResults = QuestionResult::ByExamResultId($existing->id)
                ->orderBy('id', 'asc')
                ->get();
            
            $examResult = $existing;
        } else {
            $examResult = ExamResult::create([
                'exam_id' => $exam->id,
                'user_id' => $user->id,
                'start_date' => now(),
                'last_date' => $current,
                'duration' => $exam->duration,
            ]);

            $questions = Question::where('packet_id', '=', $exam->packet->id)->inRandomOrder()->get();

            foreach ($questions as $question) {
                QuestionResult::create([
                    'exam_result_id' => $examResult->id,
                    'question_id' => $question->id,
                ]);
            }

            $questionResults = QuestionResult::ByExamResultId($examResult->id)
                ->orderBy('id', 'asc')
                ->get();
        }

        return view('exams.show', [
            'exam' => $exam,
            'examResult' => $examResult,
            'questions' => $questionResults,
        ]);
    }

    /**
     * Show the guard page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function guard(int $id)
    {
        $exam = Exam::findOrFail($id);

        return view('exams.guard', [
            'exam' => $exam,
        ]);
    }

    /**
     * Check if the token is correct
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkToken(Request $request, int $id)
    {
        $exam = Exam::findOrFail($id);

        if ($exam->token) {
            $validated = $request->validate([
                "token" => "required|string",
            ]);

            if (strtolower($validated["token"]) === strtolower($exam->token)) {
                return redirect()->route("exams.show", ["id" => $exam->id, "token" => $validated["token"]]);
            } else {
                return redirect()->back()->withErrors(["token" => "Token salah!"]);
            }
        }

        return redirect()->route("exams.show", ["id" => $exam->id]);
    }
}
