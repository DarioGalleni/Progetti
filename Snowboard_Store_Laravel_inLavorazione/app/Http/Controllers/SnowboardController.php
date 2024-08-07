<?php

namespace App\Http\Controllers;

use App\Models\snowboard;
use Illuminate\Http\Request;

class SnowboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function added(Snowboard $snowboard)
    {
        $snowboard = Snowboard::all();
        return view('indexAdded', compact('snowboard'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function crea()
    {
        return view('crea');
    }

    /**
     * Display the specified resource.
     */
    public function show(snowboard $snowboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(snowboard $snowboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, snowboard $snowboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(snowboard $snowboard)
    {
        //
    }
}
