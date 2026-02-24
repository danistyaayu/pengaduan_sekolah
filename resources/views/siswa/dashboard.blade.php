@extends('layouts.app')

@section('title', 'Dashboard Siswa')

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
        <div class="text-5xl">📊</div>
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Dashboard Siswa</h1>
            <p class="text-slate-600">Ringkasan pengaduan yang kamu buat</p>
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
            <p class="text-xs text-slate-500 mt-1">Menunggu respon</p>
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

    <!-- PENGADUAN SAYA -->
    <div class="card max-w-5xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-extrabold">📋 Pengaduan Saya</h2>
            <a href="{{ route('siswa.aspirasi.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-blue-700">
                ➕ Buat Pengaduan
            </a>
        </div>

        @forelse($myAspirasi as $a)
            <div class="flex justify-between items-center p-4 rounded-xl border mb-4 hover:bg-slate-50">
                <div>
                    <p class="font-bold text-blue-600">{{ $a->aspirasi_code }}</p>
                    <p class="font-semibold">{{ $a->title }}</p>
                    <p class="text-xs text-slate-500">
                        {{ $a->created_at->format('d M Y') }}
                    </p>
                </div>
                <div class="text-right">
                    {!! $a->getStatusBadge() !!}
                    <a href="{{ route('siswa.aspirasi.show',$a->id) }}"
                       class="block mt-2 text-sm text-blue-600 font-semibold hover:underline">
                        Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-slate-500 py-10">
                📝 Belum ada pengaduan
            </div>
        @endforelse
    </div>

</div>
@endsection
