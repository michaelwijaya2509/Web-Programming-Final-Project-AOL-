<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Court::query()->where('is_active', true);

        // Handle Search nama lapangan / lokasi / tipe lapangan
        if($request->filled('search')){
            $query->where(function ($q) use ($request){
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->min_price && $request->max_price) {
            $query->whereBetween('price_per_hour', [
                $request->min_price, $request->max_price
            ]);
        }

        $courts = $query->get();

        return view('courts.index', compact('courts'));
    }

    // detail lapangan
    public function show($id)
    {
        $court = Court::findOrFail($id);
        return view('courts.show', compact('court'));
    }
}
