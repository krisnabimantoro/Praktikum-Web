<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Interest;


class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $interests= Interest::with('event')->get();
        return response()->json($interests);;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $interest = Interest::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'id_event' => $request->id_event,

        ]);
        return response()->json([
            'message' => 'Interest created successfully',
            'interest' => $interest,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $interest = Interest::with('event')->findOrFail($id);

        return response()->json($interest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $interest = Interest::findOrFail($id);
        $interest ->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'id_event' => $request->id_event,

        ]);
        return response()->json([
            'message' => 'Interest update successfully',
            'interest' => $interest,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $interest = Interest::findOrFail($id);
        $interest->delete();
        return response()->json([
            'message' => 'Interest deleted successfully',
            'interest' => $interest,
        ], 200);
    }
}