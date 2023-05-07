<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\Dealer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $participants = Dealer::where('status', 2)->get()->all();
        return view('admin.projects.create', compact('participants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = Project::create($request->all());

        foreach($request->participants as $vendor_id) {
            $project->biddings()->create([
                'dealer_id' => $vendor_id,
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $allParticipants = $project->biddings()->get()->all();
        $participants = [];
        foreach($allParticipants as $participant) {
            $participants[] =[
                "id" => $participant->id,
                "name" => $participant->dealer->organization_name
            ];
        }


        return view('admin.projects.show', compact('project', 'participants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // dd($project->biddings()->pluck('dealer_id')->all());
        $currentParticipants =$project->biddings()->pluck('dealer_id')->all();
        $participants = Dealer::where('status', 2)->get()->all();
        return view('admin.projects.edit', compact('project', 'participants', 'currentParticipants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        if($request->choose_winner) {
            $bidding = Bidding::find($request->bidding_id);
            $project->update([
                'dealer_id' => $bidding->dealer_id,
            ]);
            return redirect()->route('projects.index')->with('success', 'Project updated successfully');
        }


        
        $project->update($request->all());

        $currentParticipants = $project->biddings()->pluck('id')->all();
        $newParticipants = $request->participants;

        foreach($currentParticipants as $currentParticipant) {
            $p = Bidding::find($currentParticipant);
            $p->delete();
        }

        foreach($newParticipants as $newParticipant) {
            $project->biddings()->create([
                'dealer_id' => $newParticipant,
            ]);
        }


        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(["success" => "Project Record Deleted Successfully"],201);
    }
}
