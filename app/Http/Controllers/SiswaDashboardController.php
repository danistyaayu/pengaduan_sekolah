<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        // Cek apakah user adalah siswa
        if (Auth::check() && Auth::user()->role !== 'siswa') {
            return redirect('/login/siswa');
        }

        $user = Auth::user();
        
        $stats = [
            'total' => Aspirasi::where('user_id', $user->id)->count(),
            'pending' => Aspirasi::where('user_id', $user->id)->where('status', 'pending')->count(),
            'in_progress' => Aspirasi::where('user_id', $user->id)->where('status', 'in_progress')->count(),
            'resolved' => Aspirasi::where('user_id', $user->id)->where('status', 'resolved')->count(),
        ];

        $progress = $stats['total'] > 0 ? round(($stats['resolved'] / $stats['total']) * 100, 2) : 0;

        $myAspirasi = Aspirasi::with(['balasan.user', 'historiStatus'])
            ->where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        return view('siswa.dashboard', compact('stats', 'progress', 'myAspirasi'));
    }
}