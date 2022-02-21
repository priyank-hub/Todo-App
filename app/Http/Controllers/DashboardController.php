<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->date) {
            $transactions = Transaction::where([
            'user_id' => Auth::user()->id,
                'deleted_at' => NULL,
            ])
            ->whereDate('created_at', '=', $request->date)
            ->get();
        }
        else {
            $transactions = Transaction::where([
                'user_id' => Auth::user()->id,
                'deleted_at' => NULL,
            ])
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->get();
        }

        return Inertia::render('Dashboard/Index', [
            'transactions' => $transactions,
            'currentdate' => $request->date ? $request->date : Carbon::today()->toDateString() ,
        ]);
    }
}
