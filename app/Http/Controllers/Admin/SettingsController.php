<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Modelor;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use Modelor;

    /**
     * Show the form for editing the specified resource.
     * 
     * @return void
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return void
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
