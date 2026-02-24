@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    body {
         background: #f8fafc;
    }

    .card {
        background: white;
        border-radius: 1.25rem;
        padding: 1.5rem;
        box-shadow: 0 8px 25px rgba(0,0,0,.06);
    }

    .card-soft {
        background: linear-gradient(135deg, #dbeafe, #eff6ff);
    }

    .stat-card {
        min-width: 220px;
    }

    .fade {
        animation: fade .6s ease;
    }

    @keyframes fade {
        from { opacity:0; transform: translateY(10px); }
        to { opacity:1; transform:none; }
    }
</style>

<div class="p-6 fade">

    <!-- HEADER -->
    <div class="card card-soft mb-8 flex items-center gap-6">
        <div class="text-5xl">📌</div>
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Ringkasan Hari Ini</h1>
            <p class="text-slate-600">Pantauan singkat pengaduan siswa</p>
        </div>
    </div>

    <!-- STAT CARD -->
    <div class="flex flex-wrap gap-18 mb-20">

        <div class="card stat-card">
            <p class="text-sm text-slate-500">Total Pengaduan</p>
            <p class="text-4xl font-black text-slate-800">{{ $stats['total'] }}</p>
        </div>

        <div class="card stat-card bg-blue-50">
            <p class="text-sm text-slate-500">Masih Pending</p>
            <p class="text-4xl font-black text-blue-600">{{ $stats['pending'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Perlu ditindaklanjuti</p>
        </div>

        <div class="card stat-card bg-indigo-50">
            <p class="text-sm text-slate-500">Sedang Diproses</p>
            <p class="text-4xl font-black text-indigo-600">{{ $stats['in_progress'] }}</p>
        </div>

        <div class="card stat-card bg-emerald-50">
            <p class="text-sm text-slate-500">Selesai</p>
            <p class="text-4xl font-black text-emerald-600">{{ $stats['resolved'] }}</p>
        </div>

    </div>

    <!-- PROGRESS -->
    <div class="card mb-10 max-w-3xl">
        <div class="flex justify-between mb-3">
            <p class="font-semibold text-slate-700">Tingkat Penyelesaian</p>
            <p class="font-bold text-blue-600">{{ $progress }}%</p>
        </div>
        <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
            <div class="h-3 bg-gradient-to-r from-sky-400 to-blue-500"
                 style="width: {{ $progress }}%"></div>
        </div>
    </div>

    <!-- PERLU PERHATIAN -->
    <div class="mb-10">
        <h2 class="text-xl font-extrabold mb-4">⚠️ Perlu Perhatian</h2>

        @forelse($urgentAspirasi as $aspirasi)
            <div class="card mb-4 border-l-8 border-red-400">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-red-500">{{ $aspirasi->aspirasi_code }}</p>
                        <h3 class="text-lg font-bold">{{ $aspirasi->title }}</h3>
                        <p class="text-sm text-slate-600">{{ $aspirasi->description }}</p>
                        <p class="text-xs text-slate-500 mt-2">
                            👤 {{ $aspirasi->user->name }}
                        </p>
                    </div>
                    <a href="{{ route('admin.aspirasi.show',$aspirasi->id) }}"
                       class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold">
                        Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="card text-center text-slate-500">
                🎉 Tidak ada pengaduan mendesak
            </div>
        @endforelse
    </div>

    <!-- PENGADUAN TERBARU -->
    <div class="card max-w-5xl">
        <h2 class="text-xl font-extrabold mb-4">📋 Pengaduan Terbaru</h2>

        <div class="space-y-4">
            @foreach($recentAspirasi as $a)
                <div class="flex justify-between items-center p-4 rounded-xl border hover:bg-slate-50">
                    <div>
                        <p class="font-bold text-blue-600">{{ $a->aspirasi_code }}</p>
                        <p class="font-semibold">{{ $a->title }}</p>
                        <p class="text-xs text-slate-500">{{ $a->user->name }}</p>
                    </div>
                    <div class="text-right">
                        {!! $a->getStatusBadge() !!}
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $a->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
