<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where([
            'user_id' => Auth::user()->id,
            'deleted_at' => NULL,
        ])->get();

        return Inertia::render('Dashboard/Index', [
            'transactions' => $transactions,
        ]);
    }
}
