<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Get a listing of the resource
     * 
     * @return string
     */
    public function index(Request $request): string
    {
        if ($request->has('paket-soal')) {
            $questions = Question::where('paket_soal_id', '=', (int) $request->get('paket_soal_id'))->get()->toJson();
        } else {
            $questions = Question::all()->toJson();
        }

        return $questions;
    }

    /**
     * Destroy a resource
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(Request $request)
    {
        $question = Question::findOrFail((int) $request->get('id'));

        $question->choices()->delete();
        $question->results()->delete();

        $question->delete();

        return response(null);
    }
}
