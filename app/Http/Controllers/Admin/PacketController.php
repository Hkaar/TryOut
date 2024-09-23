<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use App\Traits\Modelor;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    use Modelor;

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $packets = Packet::paginate(20);

        return view('admin.packets.index', [
            'packets' => $packets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('admin.packets.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:packets,name',
            'group_id' => 'required|numeric|exists:groups,id',
            'code' => 'required|string|max:255|unique:packets,code',
            'subject_id' => 'required|numeric|exists:subjects,id',
            'desc' => 'nullable|string',
        ]);

        $packet = new Packet;
        $packet->fill($validated)->save();

        return redirect()->route('admin.packets.index');
    }

    /**
     * Display the specified resource.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(int $id)
    {
        $packet = Packet::findOrFail($id);

        return view('admin.packets.show', [
            'packet' => $packet,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $packet = Packet::findOrFail($id);

        return view('admin.packets.edit', [
            'packet' => $packet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $packet = Packet::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'nullable|string|max:255|unique:packets,name',
            'group_id' => 'nullable|numeric|exists:groups,id',
            'code' => 'nullable|string|max:255|unique:packets,code',
            'subject_id' => 'nullable|numeric|exists:subjects,id',
            'desc' => 'nullable|string',
        ]);

        $this->updateModel($packet, $validated);
        $packet->save();

        return redirect()->route('admin.packets.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $id)
    {
        $packet = Packet::findOrFail($id);

        $packet->exams()->delete();
        $packet->questions()->delete();

        $packet->delete();

        return response(null);
    }
}
