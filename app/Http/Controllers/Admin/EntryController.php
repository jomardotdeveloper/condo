<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\EntryTrait;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    use EntryTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.entries.index', [
            'entries' => Entry::all(),
            'net' => $this->getNetBalance()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.entries.create', [
            'accounts' => $this->getSelectOptions(Account::class),
            'banks' => $this->getSelectOptions(Bank::class),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->createEntry($request);
        return redirect()->route('entries.index')->with('success', 'Entry created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entry $entry)
    {
        return view('admin.entries.edit', [
            'entry' => $entry,
            'accounts' => $this->getSelectOptions(Account::class),
            'banks' => $this->getSelectOptions(Bank::class),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        $this->updateEntry($request, $entry);
        return redirect()->route('entries.index')->with('success', 'Entry updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();
        return response()->json(["success" => "Entry Record Deleted Successfully"],201);
    }

    public function getNetBalance() {
        $entries = Entry::all();
        $net_balance = 0;
        foreach ($entries as $entry) {
            if(!$entry->account->is_in) {
                $net_balance -= $entry->amount;
            } else {
                $net_balance += $entry->amount;
            }
        }
        return $net_balance;
    }
}
