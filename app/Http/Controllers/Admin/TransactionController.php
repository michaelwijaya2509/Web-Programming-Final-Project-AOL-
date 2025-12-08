<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.transactions.index', compact('payments'));
    }
}