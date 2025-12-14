<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminVenueController extends Controller
{
    // --- VENUE MANAGEMENT ---

    public function index()
    {
        // Menampilkan daftar venue
        $venues = Venue::withCount('courts')->latest()->paginate(10);
        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        // Form tambah venue
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        // Simpan venue baru
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric',
            'open_time' => 'required',
            'close_time' => 'required',
            'venue_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('venue_image')->store('venues', 'public');

        Venue::create([
            'name' => $request->name,
            'type' => $request->type,
            'location' => $request->location,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
            'venue_image' => '/storage/' . $imagePath,
        ]);

        return redirect()->route('venue.index')->with('success', 'Venue berhasil dibuat!');
    }

    public function edit($id)
    {
        // Form edit venue & manage court
        $venue = Venue::with('courts')->findOrFail($id);
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, $id)
    {
        // Update data venue
        $venue = Venue::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'location' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'open_time' => 'required',
            'close_time' => 'required',
            'venue_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['venue_image']);

        if ($request->hasFile('venue_image')) {
            // Hapus gambar lama
            if ($venue->venue_image) {
                $oldPath = str_replace('/storage/', '', $venue->venue_image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('venue_image')->store('venues', 'public');
            $data['venue_image'] = '/storage/' . $path;
        }

        $venue->update($data);

        return redirect()->route('venue.index')->with('success', 'Venue berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus venue
        $venue = Venue::findOrFail($id);

        if ($venue->venue_image) {
            $oldPath = str_replace('/storage/', '', $venue->venue_image);
            Storage::disk('public')->delete($oldPath);
        }

        $venue->delete(); // Courts di dalamnya akan terhapus otomatis jika sudah setup cascade on delete di migration

        return redirect()->route('venue.index')->with('success', 'Venue berhasil dihapus!');
    }

    // --- COURT MANAGEMENT (Di dalam Venue) ---

    public function storeCourt(Request $request, Venue $venue)
    {
        // Tambah court baru ke dalam venue
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $venue->courts()->create([
            'name' => $request->name,
            'is_active' => true,
            'price' => $venue->price_per_hour // Opsional: jika court punya harga beda, sesuaikan logic ini
        ]);

        return back()->with('success', 'Lapangan berhasil ditambahkan!');
    }

    public function destroyCourt(Court $court)
    {
        // Hapus court spesifik
        $court->delete();
        return back()->with('success', 'Lapangan berhasil dihapus!');
    }

    public function toggleCourtStatus(Court $court)
    {
        // Ubah status aktif/nonaktif
        $court->update([
            'is_active' => !$court->is_active
        ]);

        return back()->with('success', 'Status lapangan diperbarui!');
    }
}
