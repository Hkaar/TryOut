<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Services\FilterService;
use App\Traits\Modelor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    use Modelor;

    public function __construct(
        protected FilterService $filterService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $groups = Group::query();

        if ($request->has('search') && $request->input('search')) {
            $this->filterService->search($groups, 'name', $request->input('search'));
        }

        if ($request->has('order')) {
            $this->filterService->order($groups, $request->input('order') === 'latest' ? false : true);
        }

        $groups = $groups->paginate(15, ['id', 'name']);

        return view('admin.groups.index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
        ]);

        $group = new Group;
        $group->fill($validated)->save();

        return redirect()->route('admin.groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $group = Group::findOrFail($id);

        return view('admin.groups.show', [
            'group' => $group,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $group = Group::findOrFail($id);

        return view('admin.groups.edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $group = Group::findOrFail($id);

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255', Rule::unique('groups', 'name')->ignore($group->id)],
        ]);

        $this->updateModel($group, $validated);
        $group->save();

        return redirect()->route('admin.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $id)
    {
        $group = Group::findOrFail($id);

        $group->users()->detach();
        $group->exams()->delete();
        $group->packets()->delete();

        $group->delete();

        return response(null);
    }
}
