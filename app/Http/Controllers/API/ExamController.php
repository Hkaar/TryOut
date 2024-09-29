<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

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
}
