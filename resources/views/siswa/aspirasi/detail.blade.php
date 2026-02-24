@extends('layouts.app')

@section('title', 'Detail Pengaduan - Siswa')
@section('page-title', '🔍 Detail Pengaduan')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Info Card -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $aspirasi->title }}</h1>
                <p class="text-gray-600 mt-1">Kode: <span class="font-mono font-bold text-blue-600">{{ $aspirasi->aspirasi_code }}</span></p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600">📅 {{ $aspirasi->created_at->format('d M Y, H:i') }}</p>
                <p class="text-xs text-gray-500">Updated: {{ $aspirasi->updated_at->diffForHumans() }}</p>
            </div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
            <div>
                <p class="text-xs text-gray-500">KATEGORI</p>
                <p class="font-semibold text-gray-800">{{ $aspirasi->category }}</p>
            </div>
            
            <div>
                <p class="text-xs text-gray-500">LOKASI</p>
                <p class="font-semibold text-gray-800">{{ $aspirasi->location ?? '-' }}</p>
            </div>
            
            <div>
                <p class="text-xs text-gray-500">STATUS</p>
                <p>{!! $aspirasi->getStatusBadge() !!}</p>
            </div>
        </div>
        
        <div class="mb-4">
            <p class="text-xs text-gray-500 mb-2">📝 DESKRIPSI LENGKAP</p>
            <div class="bg-gray-50 p-4 rounded-lg text-gray-700 whitespace-pre-line">
                {{ $aspirasi->description }}
            </div>
        </div>
    </div>
    
    <!-- Timeline Status -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">📈 TIMELINE STATUS</h2>
        
        <div class="relative pl-6 border-l-2 border-green-200">
            @foreach($aspirasi->historiStatus as $history)
            <div class="mb-6">
                <div class="absolute w-4 h-4 bg-green-600 rounded-full -left-2 mt-1.5"></div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $history->new_status }}
                                @if($history->old_status)
                                    <span class="text-sm text-gray-600">(dari {{ $history->old_status }})</span>
                                @endif
                            </p>
                            <p class="text-sm text-gray-600 mt-1">{{ $history->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                            {{ $history->user->name }}
                        </span>
                    </div>
                    @if($history->note)
                    <p class="text-sm text-gray-700 mt-2">📝 {{ $history->note }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Balasan Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">💬 BALASAN & DISKUSI</h2>
        
        <div class="space-y-4 mb-6">
            @foreach($aspirasi->balasan as $balasan)
            <div class="border-l-4 {{ $balasan->user->isAdmin() ? 'border-blue-500' : 'border-green-500' }} bg-gray-50 p-4 rounded-r-lg">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <span class="font-semibold text-gray-800">{{ $balasan->user->name }}</span>
                        <span class="text-xs text-gray-500 ml-2">
                            ({{ $balasan->user->isAdmin() ? 'Admin' : 'Siswa' }})
                        </span>
                    </div>
                    <span class="text-xs text-gray-500">{{ $balasan->created_at->format('d M Y, H:i') }}</span>
                </div>
                <p class="text-gray-700">{{ $balasan->message }}</p>
            </div>
            @endforeach
        </div>
        
        <!-- Reply Form (Only if status is not resolved) -->
        @if($aspirasi->status != 'resolved')
        <form method="POST" action="{{ route('siswa.aspirasi.reply', $aspirasi->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tulis Balasan/Komentar</label>
                <textarea name="message" rows="3" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                          placeholder="Tulis balasan atau tambahan informasi...">{{ old('message') }}</textarea>
            </div>
            
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-semibold">
                💬 Kirim Balasan
            </button>
        </form>
        @endif
    </div>
    
    <div class="mt-6">
        <a href="{{ route('siswa.aspirasi.index') }}" 
           class="text-gray-600 hover:text-gray-800 flex items-center">
            ← Kembali ke Daftar Pengaduan
        </a>
    </div>
</div>
@endsection