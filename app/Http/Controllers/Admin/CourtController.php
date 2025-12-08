<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        return view('admin.courts.index', compact('courts'));
    }

    public function create()
    {
        return view('admin.courts.create');
    }

    public function store(Request $request)
    {
        Court::create($request->all());
        return redirect('/admin/courts');
    }

    public function edit($id)
    {
        $court = Court::findOrFail($id);
        return view('admin.courts.edit', compact('court'));
    }

    public function update(Request $request, $id)
    {
        $court = Court::findOrFail($id);
        $court->update($request->all());
        return redirect('/admin/courts');
    }

    public function destroy($id)
    {
        Court::destroy($id);
        return back();
    }
}
