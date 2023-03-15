<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.accounts.index', [
            'accounts' => Account::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accounts.create', ['types' => $this->accountTypes()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:accounts', 
        ]);

        Account::create([
            'code' => $request->code,
            'name' => $request->name,
            'is_in' => $request->is_in == Account::CASH_IN,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('admin.accounts.edit', [
            'account' => $account,
            'types' => $this->accountTypes(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'code' => 'required|unique:accounts,code,'.$account->id, 
        ]);

        $account->update($request->all());

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json(["success" => "Account Record Deleted Successfully"],201);
    }

    public function accountTypes () {
        return [
            [
                'id' => Account::CASH_IN,
                'name' => 'Cash In',
            ],
            [
                'id' => Account::CASH_OUT,
                'name' => 'Cash Out',
            ],
        ];
    }
}
