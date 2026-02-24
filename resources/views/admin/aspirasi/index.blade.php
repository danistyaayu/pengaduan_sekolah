@extends('layouts.app')

@section('title', 'Daftar Pengaduan - Admin')
@section('page-title', '📝 Daftar Pengaduan')

@section('content')
<!-- Filter Section -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.aspirasi.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">STATUS</label>
            <select name="status" class="w-full px-3 py-2 border rounded-lg text-sm">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">PRIORITAS</label>
            <select name="priority" class="w-full px-3 py-2 border rounded-lg text-sm">
                <option value="">Semua Prioritas</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>
        
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">KATEGORI</label>
            <select name="category" class="w-full px-3 py-2 border rounded-lg text-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">TANGGAL</label>
            <input type="date" name="date" value="{{ request('date') }}" class="w-full px-3 py-2 border rounded-lg text-sm">
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-full">
                🔍 Filter
            </button>
        </div>
    </form>
</div>

<!-- Aspirasi Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">KODE</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">JUDUL</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">KATEGORI</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">SISWA</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">STATUS</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">PRIORITAS</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">TANGGAL</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-600 uppercase">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aspirasi as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-mono font-bold text-blue-600">{{ $item->aspirasi_code }}</td>
                    <td class="p-4 font-semibold text-gray-800">{{ $item->title }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            {{ $item->category }}
                        </span>
                    </td>
                    <td class="p-4 text-sm">
                        <div>{{ $item->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $item->user->class }} {{ $item->user->major }}</div>
                    </td>
                    <td class="p-4">{!! $item->getStatusBadge() !!}</td>
                    <td class="p-4">{!! $item->getPriorityBadge() !!}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-4">
                        <a href="{{ route('admin.aspirasi.show', $item->id) }}" 
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm font-semibold">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t">
        {{ $aspirasi->appends(request()->query())->links() }}
    </div>
</div>
@endsection