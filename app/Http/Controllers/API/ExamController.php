<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\QuestionResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    /**
     * Get the statistics of exams
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExamStatistics(Request $request)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $weeklyData = [];
        $dates = [];

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $formattedDate = $date->toDateString();
            $dates[] = $formattedDate;

            $dailyUserCount = ExamResult::whereDate('created_at', $formattedDate)->distinct('user_id')->count();
            $weeklyData[] = $dailyUserCount;
        }

        return response()->json([
            'daily_user_counts' => $weeklyData,
            'dates' => $dates,
        ]);
    }

    /**
     * Get the question data in the form of json
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuestion(int $examResultId, int $questionId)
    {
        $questionResult = QuestionResult::with(['question.choices'])->findOrFail($questionId);

        $response = [
            'id' => $questionResult->id,
            'question_id' => $questionResult->question_id,
            'correct' => $questionResult->correct,
            'not_sure' => $questionResult->not_sure,
            'exam_result_id' => $questionResult->exam_result_id,
            'answer' => $questionResult->answer,
            'type' => $questionResult->question->type->name ?? '',
            'content' => $questionResult->question->content,
            'choices' => $questionResult->question->choices->map(function ($choice) {
                return [
                    'id' => $choice->id,
                    'content' => $choice->is_image === 1 ? Storage::url($choice->content) : $choice->content,
                    'is_image' => $choice->is_image,
                ];
            }),
            'img' => $questionResult->question->img ? Storage::url($questionResult->question->img) : null,
        ];

        return response()->json($response);
    }

    /**
     * Get the next question from the current question id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNextQuestion(int $examResultId, int $questionId)
    {
        $nextQuestion = QuestionResult::with(['question.choices'])->byExamResultId($examResultId)
            ->where('id', '>', $questionId)
            ->orderBy('id')
            ->first();

        if ($nextQuestion) {
            $response = [
                'id' => $nextQuestion->id,
                'question_id' => $nextQuestion->question_id,
                'correct' => $nextQuestion->correct,
                'not_sure' => $nextQuestion->not_sure,
                'exam_result_id' => $nextQuestion->exam_result_id,
                'answer' => $nextQuestion->answer,
                'type' => $nextQuestion->question->type->name ?? '',
                'content' => $nextQuestion->question->content,
                'choices' => $nextQuestion->question->choices->map(function ($choice) {
                    return [
                        'id' => $choice->id,
                        'content' => $choice->is_image === 1 ? Storage::url($choice->content) : $choice->content,
                        'is_image' => $choice->is_image,
                    ];
                }),
                'img' => $nextQuestion->question->img ? Storage::url($nextQuestion->question->img) : null,
            ];

            return response()->json($response);
        }

        return response()->json(['message' => 'No more questions'], 404);
    }

    /**
     * Get the previous question from the current question id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPreviousQuestion(int $examResultId, int $questionId)
    {
        $previousQuestion = QuestionResult::with(['question.choices'])->byExamResultId($examResultId)
            ->where('id', '<', $questionId)
            ->orderBy('id', 'desc')
            ->first();

        if ($previousQuestion) {
            $response = [
                'id' => $previousQuestion->id,
                'question_id' => $previousQuestion->question_id,
                'correct' => $previousQuestion->correct,
                'not_sure' => $previousQuestion->not_sure,
                'exam_result_id' => $previousQuestion->exam_result_id,
                'answer' => $previousQuestion->answer,
                'type' => $previousQuestion->question->type->name ?? '',
                'content' => $previousQuestion->question->content,
                'choices' => $previousQuestion->question->choices->map(function ($choice) {
                    return [
                        'id' => $choice->id,
                        'content' => $choice->is_image === 1 ? Storage::url($choice->content) : $choice->content,
                        'is_image' => $choice->is_image,
                    ];
                }),
                'img' => $previousQuestion->question->img ? Storage::url($previousQuestion->question->img) : null,
            ];

            return response()->json($response);
        }

        return response()->json(['message' => 'No previous questions'], 404);
    }

    /**
     * Save a question into the database
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function saveQuestion(Request $request, int $examResultId, int $questionId)
    {
        $result = QuestionResult::findOrFail($questionId);

        $validated = $request->validate([
            'answer' => 'nullable|string',
        ]);

        $question = $result->question;

        if ($validated['answer'] && strtolower($question->rightAnswer->content) === strtolower($validated['answer'])) {
            $result->answer = $question->rightAnswer->content;
            $result->correct = 1;
        } else {
            $result->answer = $validated['answer'];
            $result->correct = 0;
        }

        $result->save();

        return response(null);
    }

    /**
     * Mark the question as not sure
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function notSure(Request $request, int $examResultId, int $questionId)
    {
        $result = QuestionResult::findOrFail($questionId);

        if ($result->not_sure === 0) {
            $result->not_sure = 1;
        } else {
            $result->not_sure = 0;
        }

        $result->save();

        return response()->json([
            'message' => 'Successfully updated resource!',
        ], 200);
    }

    /**
     * Mark the exam as done
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function finishExam(int $id)
    {
        $result = ExamResult::findOrFail($id);

        $result->finished = 1;
        $result->finish_date = Carbon::parse((string) now());
        $result->save();

        return response()->json([
            'redirect' => route(name: 'home'),
        ]);
    }

    /**
     * Get the remaining exam time
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function remainingExamTime(Request $request, int $id)
    {
        $result = ExamResult::findOrFail($id);
        $current = Carbon::parse((string) now());

        $startTime = Carbon::parse($result->last_date);
        $diff = $startTime->diffInSeconds($current);

        $remainingTime = ($result->duration * 60) - $diff;

        $result->duration = (int) $remainingTime / 60;
        $result->last_date = Carbon::parse((string) now());
        $result->save();

        if ($remainingTime > 0) {
            return response()->json([
                'valid' => true,
                'remaining' => $remainingTime,
            ]);
        }

        $this->finishExam($id);

        return response()->json([
            'valid' => false,
            'remaining' => 0,
        ]);
    }
}
