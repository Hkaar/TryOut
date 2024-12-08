<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionChoice;
use App\Models\QuestionType;
use App\Services\FilterService;
use App\Traits\Modelor;
use App\Traits\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    use Modelor, Uploader;

    public function __construct(
        protected FilterService $filterService,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $questions = Question::with(['packet', 'type']);

        if ($request->has('search') && $request->input('search')) {
            $this->filterService->search($questions, 'content', $request->input('search'));
        }

        if ($request->has('order')) {
            $this->filterService->order($questions, $request->input('order') === 'latest' ? false : true);
        }

        $questions = $questions->paginate(15);

        return view('admin.questions.index', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'packet_id' => 'required|numeric|exists:packets,id',
            'question_type_id' => 'required|numeric|exists:question_types,id',
            'content' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'choices' => 'nullable|array',
        ]);

        $question = new Question;
        $question->fill($validated);

        if ($request->hasFile('img')) {
            $filePath = $this->uploadImage($request->file('img'));
            $question->img = $filePath;
        }

        $question->save();

        $type = QuestionType::where('id', '=', $validated['question_type_id'])->first();
        $choices = $validated['choices'];

        if (strtolower($type->name) === 'essay') {
            QuestionChoice::create([
                'question_id' => $question->id,
                'content' => $choices['answer'],
                'correct' => $choices['status'] === 'true' ? 1 : 0,
            ]);
        } else {
            foreach ($choices as $choice) {
                $questionChoice = new QuestionChoice;
                $questionChoice->question_id = $question->id;

                if (in_array('image', array_keys($choice))) {
                    $filePath = $this->uploadImage($choice['image']);
                    $questionChoice->content = $filePath;
                    $questionChoice->is_image = 1;
                } else {
                    $questionChoice->content = $choice['answer'];
                }

                $questionChoice->correct = $choice['status'] === 'true' ? 1 : 0;

                $questionChoice->save();
            }
        }

        return redirect()->route('admin.questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     *
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
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
