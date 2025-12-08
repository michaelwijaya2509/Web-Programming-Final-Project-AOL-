<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        // by default, dia akan nampilin semua lapangannya
        $query = Court::query()->where('is_active', true);

        // Handle Search nama lapangan / lokasi / tipe lapangan
        if($request->filled('search')){
            $query->where(function ($q) use ($request){
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
            });
        }

        // Filter jenis / tipe lapangan
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter harga (range)
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price_per_hour', [
                $request->min_price, $request->max_price
            ]);
        }

        // Ambil data
        $courts = $query->latest()->get();

        // lempar ke home
        return view('home', compact($courts));
    }
}
