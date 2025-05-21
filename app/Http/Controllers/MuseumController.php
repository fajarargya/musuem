<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Museum;
use Illuminate\Support\Facades\Storage;

class MuseumController extends Controller
{
 
    // galeri di landing page
    public function welcome()
    {
        $museums = Museum::latest()->take(8)->get();
        return view('welcome', compact('museums'));
    }
    // Menampilkan daftar museum
    public function index(Request $request)
    {
        $query = Museum::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('kota', 'like', "%{$search}%");
            });
        }

        $user = auth()->user();

        if ($user) {
            $favoriteMuseumIds = $user->favoriteMuseums->pluck('id')->toArray();

            if (!empty($favoriteMuseumIds)) {
                // Urutkan favorit di atas
                $query->orderByRaw("FIELD(id, " . implode(',', $favoriteMuseumIds) . ") DESC");
            }
        }

        $museums = $query->orderBy('nama')->paginate(9);

        return view('museum.index', compact('museums'));
    }
    
    public function toggleFavorite($id)
    {
        $user = auth()->user();
        $museum = Museum::findOrFail($id);
    
        if ($user->favoriteMuseums->contains($museum->id)) {
            $user->favoriteMuseums()->detach($museum->id);
        } else {
            $user->favoriteMuseums()->attach($museum->id);
        }
    
        return redirect()->back();
    }
    // Menampilkan detail museum
    public function show($id)
    {
        $museum = Museum::findOrFail($id);

        // Ambil 6 museum lain (acak), selain museum yang sedang dibuka
        $relatedMuseums = Museum::where('id', '!=', $id)
                                ->inRandomOrder()
                                ->take(9)
                                ->get();

        return view('museum.show', compact('museum', 'relatedMuseums'));
    }

    // Form tambah museum - hanya untuk admin
    public function create()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('museum.index')->with('error', 'Anda bukan admin.');
        }

        return view('museum.create');
    }

    // Simpan data museum baru - hanya untuk admin
    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('museum.index')->with('error', 'Anda bukan admin.');
        }

        // Validasi input
        $request->validate([
            'nama' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'jumlah_koleksi' => 'required|integer',
            'jenis_pemilik' => 'required',
            'pemilik' => 'required',
            'tipe_akhir' => 'required',
            'nomor_pendaftaran' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        // Proses penyimpanan gambar (jika ada)
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar-museum', 'public');
        }

        // Simpan data museum ke database
        Museum::create([
            'nama' => $request->nama,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'jumlah_koleksi' => $request->jumlah_koleksi,
            'jenis_pemilik' => $request->jenis_pemilik,
            'pemilik' => $request->pemilik,
            'tipe_akhir' => $request->tipe_akhir,
            'nomor_pendaftaran' => $request->nomor_pendaftaran,
            'gambar' => $gambarPath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('museum.index')->with('success', 'Museum berhasil ditambahkan!');
    }

    // Form edit museum - hanya untuk admin
    public function edit($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('museum.index')->with('error', 'Anda bukan admin.');
        }

        $museum = Museum::findOrFail($id);
        return view('museum.edit', compact('museum'));
    }

    // Update data museum - hanya untuk admin
    public function update(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('museum.index')->with('error', 'Anda bukan admin.');
        }

        // Validasi input
        $request->validate([
            'nama' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'jumlah_koleksi' => 'required|integer',
            'jenis_pemilik' => 'required',
            'pemilik' => 'required',
            'tipe_akhir' => 'required',
            'nomor_pendaftaran' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        
        $museum = Museum::findOrFail($id);

        // Proses penyimpanan gambar jika ada
        $gambarPath = $museum->gambar;
        if ($request->hasFile('gambar')) {
            if ($museum->gambar) {
                Storage::disk('public')->delete($museum->gambar);
            }
            $gambarPath = $request->file('gambar')->store('gambar-museum', 'public');
        }

        // Update data museum
        $museum->update([
            'nama' => $request->nama,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'jumlah_koleksi' => $request->jumlah_koleksi,
            'jenis_pemilik' => $request->jenis_pemilik,
            'pemilik' => $request->pemilik,
            'tipe_akhir' => $request->tipe_akhir,
            'nomor_pendaftaran' => $request->nomor_pendaftaran,
            'gambar' => $gambarPath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('museum.index')->with('success', 'Museum berhasil diperbarui!');
    }

    // Hapus museum - hanya untuk admin
    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('museum.index')->with('error', 'Anda bukan admin.');
        }

        $museum = Museum::findOrFail($id);

        if ($museum->gambar) {
            Storage::disk('public')->delete($museum->gambar);
        }

        $museum->delete();

        return redirect()->route('museum.index')->with('success', 'Museum berhasil dihapus!');
    }

}
