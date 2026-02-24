<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Cek apakah user adalah admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/login/admin');
        }

        $stats = [
            'total' => Aspirasi::count(),
            'pending' => Aspirasi::where('status', 'pending')->count(),
            'in_progress' => Aspirasi::where('status', 'in_progress')->count(),
            'resolved' => Aspirasi::where('status', 'resolved')->count(),
            'rejected' => Aspirasi::where('status', 'rejected')->count(),
        ];

        $progress = $stats['total'] > 0 ? round(($stats['resolved'] / $stats['total']) * 100, 2) : 0;

        $recentAspirasi = Aspirasi::with('user')
            ->latest()
            ->limit(10)
            ->get();

        $urgentAspirasi = Aspirasi::with('user')
            ->where('status', 'pending')
            ->orWhere('priority', 'urgent')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'progress', 'recentAspirasi', 'urgentAspirasi'));
    }
}