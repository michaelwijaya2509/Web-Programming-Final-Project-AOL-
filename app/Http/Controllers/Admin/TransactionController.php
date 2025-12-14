<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->latest()->paginate(20);
        return view('admin.transactions.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::with(['booking.user', 'booking.venue'])->findOrFail($id);
        return view('admin.transactions.show', compact('payment'));
    }
}