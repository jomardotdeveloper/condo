<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\User;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dealers = Dealer::where('status', $_GET['status']);
        return view('admin.dealers.index', [
            'dealers' => $dealers->get()->all(),
            'status_name' => Dealer::STATUS[$_GET['status']],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dealers.create', [
            'forms' => $this->getEnumSelectOptions(Dealer::FORM_OF_ORGANIZATION),
            'status' => $this->getEnumSelectOptions(Dealer::STATUS),
            'type_checklists' => Dealer::TYPE_CHECKLISTS,
            'category_checklists' => Dealer::CATEGORY_CHECKLISTS,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->all();
        if(array_key_exists("type_checklists" , $values))
            $values["type_checklists"] = implode(",", $values["type_checklists"]);

        if(array_key_exists("category_checklists" , $values))
            $values["category_checklists"] = implode(",", $values["category_checklists"]);

        $values['status'] = 1;

        if($request->hasFile('mayors_permit_src')) {
            $values['mayors_permit_src'] =  $this->uploadFile($request, 'mayors_permit_src', 'dealers');
        }

        if($request->hasFile('dti_src')) {
            $values['dti_src'] =  $this->uploadFile($request, 'dti_src', 'dealers');
        }

        if($request->hasFile('bir_src')) {
            $values['bir_src'] =  $this->uploadFile($request, 'bir_src', 'dealers');
        }

        if($request->hasFile('afs_src')) {
            $values['afs_src'] =  $this->uploadFile($request, 'afs_src', 'dealers');
        }

        if($request->hasFile('company_profile_src')) {
            $values['company_profile_src'] =  $this->uploadFile($request, 'company_profile_src', 'dealers');
        }

        Dealer::create($values);

        return redirect()->route('dealers.index', ['status' => 1])->with('success', 'Dealer successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dealer $dealer)
    {
        return view('admin.dealers.show', [
            'dealer' => $dealer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dealer $dealer)
    {
        return view('admin.dealers.edit', [
            'dealer' => $dealer,
            'forms' => $this->getEnumSelectOptions(Dealer::FORM_OF_ORGANIZATION),
            'status' => $this->getEnumSelectOptions(Dealer::STATUS),
            'type_checklists' => Dealer::TYPE_CHECKLISTS,
            'category_checklists' => Dealer::CATEGORY_CHECKLISTS,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dealer $dealer)
    {
        $values = $request->all();
        if(array_key_exists("type_checklists" , $values))
            $values["type_checklists"] = implode(",", $values["type_checklists"]);
        else
            $values["type_checklists"] = null;

        if(array_key_exists("category_checklists" , $values))
            $values["category_checklists"] = implode(",", $values["category_checklists"]);
        else
            $values["category_checklists"] = null;

        if($request->hasFile('mayors_permit_src')) {
            $values['mayors_permit_src'] =  $this->uploadFile($request, 'mayors_permit_src', 'dealers');
        }

        if($request->hasFile('dti_src')) {
            $values['dti_src'] =  $this->uploadFile($request, 'dti_src', 'dealers');
        }

        if($request->hasFile('bir_src')) {
            $values['bir_src'] =  $this->uploadFile($request, 'bir_src', 'dealers');
        }

        if($request->hasFile('afs_src')) {
            $values['afs_src'] =  $this->uploadFile($request, 'afs_src', 'dealers');
        }

        if($request->hasFile('company_profile_src')) {
            $values['company_profile_src'] =  $this->uploadFile($request, 'company_profile_src', 'dealers');
        }

        $dealer->update($values);
        return redirect()->route('dealers.index', ['status' => $request->status])->with('success', 'Dealer successfully updated.');
    }

    public function storeUser(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $dealer = Dealer::find($request->dealer_id);
        $user = $this->createUser($request, User::VENDOR);
        $dealer->user_id = $user->id;
        $dealer->save();
        return redirect()->route('dealers.index', ['status' => 2])->with('success', 'User created successfull.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
