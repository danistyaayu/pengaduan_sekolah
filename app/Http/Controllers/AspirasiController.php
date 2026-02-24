<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Balasan;
use App\Models\HistoriStatus;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    // Untuk admin
    public function adminIndex(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $query = Aspirasi::with('user')->latest();

        // Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $aspirasi = $query->paginate(15);

        $categories = Aspirasi::select('category')->distinct()->pluck('category');

        return view('admin.aspirasi.index', compact('aspirasi', 'categories'));
    }

    public function adminShow($id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $aspirasi = Aspirasi::with(['user', 'balasan.user', 'historiStatus.user'])->findOrFail($id);
        return view('admin.aspirasi.detail', compact('aspirasi'));
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'note' => 'nullable|string',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        // Simpan histori status
        HistoriStatus::create([
            'aspirasi_id' => $aspirasi->id,
            'old_status' => $aspirasi->status,
            'new_status' => $request->status,
            'user_id' => Auth::id(),
            'note' => $request->note,
        ]);

        // Update status
        $aspirasi->update(['status' => $request->status]);

        // Kirim notifikasi ke siswa
        Notification::create([
            'user_id' => $aspirasi->user_id,
            'aspirasi_id' => $aspirasi->id,
            'type' => 'status_update',
            'message' => "Status pengaduan Anda telah diubah menjadi: " . ucfirst($request->status),
        ]);

        return back()->with('success', 'Status berhasil diupdate!');
    }

    public function adminReply(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
            'is_private' => 'boolean',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        Balasan::create([
            'aspirasi_id' => $aspirasi->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_private' => $request->boolean('is_private', false),
        ]);

        // Kirim notifikasi ke siswa
        if (!$request->boolean('is_private')) {
            Notification::create([
                'user_id' => $aspirasi->user_id,
                'aspirasi_id' => $aspirasi->id,
                'type' => 'new_reply',
                'message' => "Ada balasan baru untuk pengaduan Anda.",
            ]);
        }

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    // Untuk siswa
    public function siswaIndex()
    {
        if (Auth::check() && Auth::user()->role !== 'siswa') {
            return redirect('/login/siswa');
        }

        $user = Auth::user();
        $aspirasi = Aspirasi::with(['balasan.user', 'historiStatus'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('siswa.aspirasi.index', compact('aspirasi'));
    }

    public function siswaCreate()
    {
        if (Auth::check() && Auth::user()->role !== 'siswa') {
            return redirect('/login/siswa');
        }

        $categories = [
            'Fasilitas Sekolah',
            'Bullying',
            'Kurikulum',
            'Kebersihan',
            'Listrik',
            'Keamanan',
            'Lainnya'
        ];

        $locations = [
            'Kelas',
            'Kantin',
            'Toilet',
            'Perpustakaan',
            'Lapangan',
            'Laboratorium',
            'Kantor',
            'Lainnya'
        ];

        return view('siswa.aspirasi.create', compact('categories', 'locations'));
    }

    public function siswaStore(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'siswa') {
            return redirect('/login/siswa');
        }

        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'category' => 'required|string',
            'location' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Generate kode aspirasi
        $lastAspirasi = Aspirasi::latest()->first();
        $number = $lastAspirasi ? intval(substr($lastAspirasi->aspirasi_code, -4)) + 1 : 1;
        $aspirasiCode = 'ASPI-' . date('Y') . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);

        $aspirasi = Aspirasi::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,
            'aspirasi_code' => $aspirasiCode,
        ]);

        // Kirim notifikasi ke admin
       

        return redirect()->route('siswa.aspirasi.index')->with('success', "Pengaduan berhasil dibuat! Kode: {$aspirasiCode}");
    }

    public function siswaShow($id)
    {
        if (Auth::check() && Auth::user()->role !== 'siswa') {
            return redirect('/login/siswa');
        }

        $user = Auth::user();
        $aspirasi = Aspirasi::with(['balasan.user', 'historiStatus.user'])
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return view('siswa.aspirasi.detail', compact('aspirasi'));
    }

    public function siswaReply(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role !== 'siswa') {
            return redirect('/login/siswa');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $aspirasi = Aspirasi::where('user_id', $user->id)->findOrFail($id);

        Balasan::create([
            'aspirasi_id' => $aspirasi->id,
            'user_id' => $user->id,
            'message' => $request->message,
            'is_private' => false,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }
}