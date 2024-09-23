<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Traits\Modelor;
use App\Traits\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    use Modelor, Uploader;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::paginate(20);

        return view('admin.questions.index', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'packet_id' => 'required|numeric|exists:packets,id',
            'question_type_id' => 'required|numeric|exists:question_types,id',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'choices' => 'nullable|string',
        ]);

        $question = new Question;
        $question->fill($validated);

        if ($request->has('img')) {
            $filePath = $this->uploadImage($request->get('img'));
            $question->img = $filePath;
        }

        return redirect()->route('admin.questions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.show', [
            'question' => $question,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.edit', [
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'packet_id' => 'required|numeric|exists:packets,id',
            'question_type_id' => 'required|numeric|exists:question_types,id',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'choices' => 'nullable|string',
        ]);

        $this->updateModel($question, $validated, ['choices', 'img']);

        if ($request->has('img')) {
            if ($question->img) {
                Storage::disk('public')->delete($question->img);
            }

            $filePath = $this->uploadImage($request->get('img'));
            $question->img = $filePath;
        }

        $question->save();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $question = Question::findOrFail($id);

        $question->choices()->delete();
        $question->results()->delete();

        $question->delete();

        return response(null);
    }
}
