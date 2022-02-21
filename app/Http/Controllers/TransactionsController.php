<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    //
    public function store(Request $request) {
        $request->validate([
            'amount' => ['required', 'numeric', 'between:0.1,1000000'],
            'description' => ['nullable', 'string'],
        ]);

        if (Auth::user()) {
            $transaction = Transaction::create([
                'amount' => $request->amount,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]);

            return Redirect::route('dashboard')->with('success', 'Transaction created.');
        }

        return Redirect::back()->with('error', 'You are not logged In!');

    }

    public function dateChange(Request $request) {
        
        $transactions = Transaction::where([
                'user_id' => Auth::user()->id,
                'deleted_at' => NULL,
            ])
            ->whereDate('created_at', '=', $request->date)
            ->get();

        dd($transactions);
        
    }
}
