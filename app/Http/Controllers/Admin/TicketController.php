<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommentTrait;
use App\Models\Employee;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use CommentTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();

        if(auth()->user()->user_type == User::USER) {
            $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        }

        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tickets.create', [
            'employees' => $this->getSelectOptions(
                Employee::class,
                'full_name',
            ),
            'users' => $this->getOwnerSelectOptions(),
            'statuses' => $this->getEnumSelectOptions(Ticket::STATUS)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->all();

        if(auth()->user()->user_type == User::USER) {
            $values['user_id'] = auth()->user()->id;
        }

        if ($request->hasFile('attachment')) {
            $values['attachment'] = $this->uploadFile($request, 'attachment', 'attachments');
        }

        Ticket::create($values);

        
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $comments = $this->getAllComments(model : "ticket", modelId : $ticket->id);
        return view('admin.tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', [
            'ticket' => $ticket,
            'employees' => $this->getSelectOptions(
                Employee::class,
                'full_name',
            ),
            'users' => $this->getOwnerSelectOptions(),
            'statuses' => $this->getEnumSelectOptions(Ticket::STATUS)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $values = $request->all();

        if ($request->hasFile('attachment')) {
            $values['attachment'] = $this->uploadFile($request, 'attachment', 'attachments');
        }

        $ticket->update($values);
        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(["success" => "Ticket Record Deleted Successfully"],201);
    }
}
