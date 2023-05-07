<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommentTrait;
use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    use CommentTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.parkings.index', [
            'parkings' => Parking::where("user_id" , auth()->user()->id)->get()->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parking = Parking::findOrFail($id);
        return view('user.parkings.show', [
            'parking' => $parking,
            'comments' => $this->getAllComments(model : "parking", modelId : $parking->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parking = Parking::findOrFail($id);
        return view('user.parkings.edit', [
            'parking' => $parking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parking = Parking::findOrFail($id);
        $parking->update($request->all());

        return redirect()->route('user-parkings.index')->with(["success" => "Parking has been updated."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
