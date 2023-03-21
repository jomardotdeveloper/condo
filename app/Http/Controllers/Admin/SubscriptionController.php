<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\EntryTrait;
use App\Models\Application;
use App\Models\Debit;
use App\Models\Entry;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use EntryTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::all();

        if(isset($_GET['debit_id']))
        {
            $subscriptions = Subscription::where('debit_id', $_GET['debit_id'])->get();
        }
        return view('admin.subscriptions.index', [
            'subscriptions' => $subscriptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscriptions.create', [
            'debits' => $this->getSelectOptions(Debit::class, "formatted_id"),
            'payment_status' => $this->getEnumSelectOptions(config('enums.payment_status')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        if ($request->debit_id){
            $debit = Debit::find($request->debit_id);

            if($debit->type == Debit::MOVE_IN){
                $debit->subscriptions()->create($request->all());
                if($debit->is_paid) {
                    $debit->application->update([
                        'status' => Application::FINANCE_VERIFICATION,
                    ]);
                }
            } else if($debit->type == Debit::MOVE_OUT){
                $debit->subscriptions()->create($request->all());
                if($debit->is_paid) {
                    $debit->moveOut->update([
                        'status' => Application::FINANCE_VERIFICATION,
                    ]);
                }
            }
        }else {
            Subscription::create($request->all());
        }

        $payment = Subscription::latest()->first();;
        if($payment->payment_status == Subscription::PAID)
            $this->createEntryFromPayment($payment, is_in : true);
        return redirect()->route('subscriptions.index')->with('success', 'Payment created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        return view('admin.subscriptions.edit', [
            'subscription' => $subscription,
            'debits' => $this->getSelectOptions(Debit::class, "formatted_id"),
            'payment_status' => $this->getEnumSelectOptions(config('enums.payment_status')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $subscription->update($request->all());
        if($subscription->debit) {
            if ($subscription->debit->type == Debit::MOVE_IN) {
                if($subscription->debit->is_paid) {
                    $subscription->debit->application->update([
                        'status' => Application::FINANCE_VERIFICATION,
                    ]);
                } else {
                    $subscription->debit->application->update([
                        'status' => Application::FOR_PAYMENT,
                    ]);
                }
            } else if ($subscription->debit->type == Debit::MOVE_OUT) {
                if($subscription->debit->is_paid) {
                    $subscription->debit->moveOut->update([
                        'status' => Application::FINANCE_VERIFICATION,
                    ]);
                } else {
                    $subscription->debit->moveOut->update([
                        'status' => Application::FOR_PAYMENT,
                    ]);
                }
            }
        }

        if($subscription->payment_status == Subscription::PAID) {
            
            if(!$subscription->entry) {
                $this->createEntryFromPayment($subscription, is_in : true);
            } else {

                $subscription->entry->update([
                    'amount' => $subscription->amount,
                ]);
            }
        } else {
            if($subscription->entry) {
                $subscription->entry->delete();
            }
        }

        return redirect()->route('subscriptions.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        if($subscription->entry) {
            $subscription->entry->delete();
        }
        if ($subscription->debit) {
            if ($subscription->debit->type == Debit::MOVE_IN) {
                $subscription->debit->application->update([
                    'status' => Application::FOR_PAYMENT,
                ]);
            } else if ($subscription->debit->type == Debit::MOVE_OUT) {
                $subscription->debit->moveOut->update([
                    'status' => Application::FOR_PAYMENT,
                ]);
            }
        }
        $subscription->delete();
        return response()->json(["success" => "Payment Record Deleted Successfully"],201);
    }
}
