<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class HistoryBillController extends Controller
{
    public function index()
    {
        $paymentName =auth()->user()->name;

        $payments = Payment::where('name' , $paymentName)->get();
        return view('user.history_bill', compact('payments'));
    }
}
